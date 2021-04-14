function adjustForm(type) {
    let priority = document.getElementById('priority_wrapper');
    let port = document.getElementById('port_wrapper');
    let weight = document.getElementById('weight_wrapper');

    if (!priority.classList.contains('hidden')) {
        priority.classList.add('hidden');
    }

    if (!port.classList.contains('hidden')) {
        port.classList.add('hidden');
    }

    if (!weight.classList.contains('hidden')) {
        weight.classList.add('hidden');
    }

    if (type === 'MX') {
        priority.classList.remove('hidden');
    }

    if (type === 'SRV') {
        priority.classList.remove('hidden');
        port.classList.remove('hidden');
        weight.classList.remove('hidden');
    }
}

function deleteRecord(dns_record_id) {
    let action = document.getElementById('delete_form').action;

    document.getElementById('delete_form').action = action.replace('dns_record_id', dns_record_id);

    document.getElementById('dns_record').appendChild(document.createTextNode(dns_record_id));

    document.getElementById('delete_form_overlay').classList.remove('hidden');
}

function hideOverlay(id) {
    document.getElementById(id).classList.add('hidden');
}