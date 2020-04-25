<?php
require_once __DIR__ . '/../vendor/autoload.php';

function bulk_configuration() {
    $fileType = 'Xls';
    $fileName = __DIR__ . '/../exemplo.xls';

    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader( $fileType );

    /**  Define a Read Filter class implementing \PhpOffice\PhpSpreadsheet\Reader\IReadFilter  */
    class CustomFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
    {
        public function readCell($column, $row, $worksheetName = '') {
            //  Read columns A to B only
            if (in_array($column,range('A','B'))) {
                return true;
            }
            
            return false;
        }
    }

    /**  Create an Instance of our Read Filter  **/
    $filterSubset = new CustomFilter();

    $reader->setReadFilter( $filterSubset );

    $spreadsheet = $reader->load( $fileName );


    echo '<pre>';
    print_r($spreadsheet);

    require __DIR__ . '/../views/configuration.php';
}