(function(){
    var addPostForm = (function(){
        var button = document.querySelector('.btn-addpost');
        
        button.addEventListener('click', addPostSketch);
    
        function addPostSketch( event ) {
            event.preventDefault();
        
            var sketch = document.querySelector('.post-item'),
                parent = sketch.parentElement;
            
            var total = document.querySelectorAll('.post-item').length;
        
            var newPost = document.createElement('div');
            newPost.classList.add('post-item');
            newPost.innerHTML = sketch.innerHTML;
        
            var loopIndex = total + 1;
            newPost.querySelector('.loopIndex').innerHTML = loopIndex;
        
            var inputs = newPost.querySelectorAll('input, textarea, label');
        
            for( var i = 0; i < inputs.length; i++ ){
        
                if ( inputs[i].getAttribute('name') ) {
                    var name = inputs[i].getAttribute('name'),
                    newName = name.replace('[0]', '[' + (loopIndex-1)  + ']');
        
                    inputs[i].setAttribute('id', newName );
                    inputs[i].setAttribute('name', newName );
                }
        
                if ( inputs[i].getAttribute('for') ) {
                    var name = inputs[i].getAttribute('for'),
                    newName = name.replace('[0]', '[' + (loopIndex-1)  + ']');
        
                    inputs[i].setAttribute('for', newName );
                }
                        
            }
        
            parent.appendChild(newPost);
            dateInputs.refresh();
            timeInputs.refresh();
        }
    })();
    
    class CalendarInput {
        constructor( selector ) {
            this.selector = selector;
            this.targets  = document.querySelectorAll( selector );
            
            this.refresh();
        }
    
        refresh() {
            this.targets = document.querySelectorAll( this.selector );
            
            this.trackInputs( this.handleChange );
        }
    
        trackInputs( callback ) {
            this.targets.forEach(function(item, key) {
    
                item.addEventListener( 'keyup', callback );
    
            });
        }
    
        handleChange( event ) {
            var element  = event.target,
                value    = element.value.split("");
    
            value.map(function(item, index, value){
                var res = ( item.match(/\D/) ) ? false : true;
    
                if ( !res ) {
                    if ( item == '/' && ( index == 2 || index == 5 ) ) return;
                    
                    delete value[index];
                }
    
                if ( item != '/' && ( index == 2 || index == 5 ) ) {
    
                    delete value[index];            
                }
            });
    
            element.value =  value.join('');
    
        }
    
    }
    
    class TimeInput extends CalendarInput {
    
        handleChange( event ) {
            var element  = event.target,
                value    = element.value.split("");
    
            value.map(function(item, index, value){
                var res = ( item.match(/\D/) ) ? false : true;
    
                if ( !res ) {
                    if ( item == ':' && ( index == 2 || index == 5 ) ) return;
                    
                    delete value[index];
                }
    
                if ( item != ':' && ( index == 2 || index == 5 ) ) {
    
                    delete value[index];            
                }
            });
    
            element.value =  value.join('');
    
        }
    
    }
    
    var dateInputs = new CalendarInput( '.date' );
    var timeInputs = new TimeInput( '.time' );
    
    class Form {
    
        constructor( selector ) {
            this.selector = selector;
            this.target   = document.querySelector( selector );
    
            this.onSubmit();
        }
    
        onSubmit() {
            this.target.addEventListener( 'submit', this.handleSubmit );
        }
    
        handleSubmit( event ) {
            event.preventDefault();
    
            var dateList    = event.target.querySelectorAll( '.date' );
            var dateErrors  = [];
    
            dateList.forEach(function( item, index ){
                resetStyle( item );
                
                if ( item.value !== '' ) {
    
                    if ( item.value.match(/\d{2}\/\d{2}\/\d{4}/) ) {
                        
                        var checkDate = new Date( item.value.substr(6, 4) + '-' +
                                         item.value.substr(3, 2) + '-' + 
                                         item.value.substr(0, 2) );
    
                        if ( isNaN( checkDate.getDate() ) ) {
                            dateErrors.push( { 
                                id: index,
                                value: 'Incorrect date format'
                            } );
                        }
    
                    } else {
    
                        dateErrors.push( { 
                            id: index,
                            value: 'Incorrect date format'
                        } );
    
                    }
    
                }
    
            });
                        
            if ( dateErrors.length > 0 ) {
                dateErrors.forEach(function( item, index ){
                    errorStyle( dateList[ item.id ] );
                });
            }
    
            var timeList    = event.target.querySelectorAll( '.time' );
            var timeErrors  = [];
    
            timeList.forEach(function( item, index ){
                resetStyle( item );
                
                if ( item.value !== '' ) {
    
                    if ( item.value.match(/\d{2}:\d{2}:\d{2}/) ) {
                        
                        var hour    = parseInt( item.value.substr( 0, 2 ) ),
                            minute  = parseInt( item.value.substr( 3, 2 ) ),
                            second  = parseInt( item.value.substr( 6, 2 ) );
    
                        var hourCheck =     ( hour >= 0 && hour < 24 ) ? true : false,
                            minuteCheck =   ( minute >= 0 && minute < 59 ) ? true : false,
                            secondCheck =   ( second >= 0 && second < 59 ) ? true : false;
    
                        if ( !hourCheck || !minuteCheck || !secondCheck ) {
                                
                            timeErrors.push( { 
                                id: index,
                                value: 'Incorrect time format'
                            } );
    
                        }
    
                    } else {
    
                        timeErrors.push( { 
                            id: index,
                            value: 'Incorrect time format'
                        } );
    
                    }
    
                }
    
            });
    
            if ( timeErrors.length > 0 ) {
                timeErrors.forEach(function( item, index ){
                    errorStyle( timeList[ item.id ] );
                });
            }
    
            function errorStyle(item) {
                item.style.borderWidth = '2px';
                item.style.borderColor = 'red';
            }
    
            function resetStyle( item ) {
                item.setAttribute( 'style', '' );
            }

            if ( dateErrors.length === 0 && timeErrors.length === 0 ) {
                event.target.submit();
            }
    
        }
    
    }
    
    var form = new Form( 'form' );
})();