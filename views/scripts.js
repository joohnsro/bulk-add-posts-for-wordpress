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
}