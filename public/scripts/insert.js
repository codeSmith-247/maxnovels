
let list_inputs  = [];

function insert_list(parent_str) {
    parent = select(`.input.${parent_str}`);

    let value = parent.querySelector('input').value;
    parent.querySelector('input').value = '';

    if(value.replaceAll(' ', '') == '') return false;

    let blueprint = `
        <div class = 'item flex-row'>
            <span>{{value}}</span>
            <div class = 'icon round flex-center' onclick = 'remove_itm(this);'>
                <i class = 'bi bi-x-lg'></i>
            </div>
            <input type = 'hidden' name = '${parent_str}' value = '{{value}}'>
        </div>
    `;

    if(list_inputs.indexOf(parent_str) < 0) list_inputs.push(parent_str);

    parent.querySelector('.lists').innerHTML += blueprint.replaceAll('{{value}}', value);
}


function remove_itm(self) {
    self.parentNode.remove();
}

function insert_list_enter(self, parent, tag) {
    if( (tag != '' && self.key == ' ') || self.key == 'Enter' ) {
        insert_list(parent);
    }
    else return false;
}

function submit() {
    let form = select('form');

    list_inputs.forEach( inputs => {

        let new_input = document.createElement('input');
        let new_input_value = '';
        let count = 0;
        selectAll(`[name = "${inputs}"`).forEach( input => {
            if(count > 0)
            new_input_value += ',';

            new_input_value += input.value;
            
            input.remove();
            count++;
        });

        new_input.setAttribute('name', inputs);
        new_input.setAttribute('value', new_input_value);
        new_input.style.visiblity = 'hidden';
        form.appendChild(new_input);
    });

    form.submit();
}