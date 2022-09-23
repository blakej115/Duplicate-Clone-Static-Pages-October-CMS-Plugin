const addDuplicateSPBtn = () => {
    if (!window.location.pathname.includes('rainlab/pages')) {
        return;
    }

    const controlToolbar = document.querySelector('form[data-content-id="pages"] .control-toolbar');
    if (!controlToolbar) {
         return;
    }

    let cloneBtn = document.createElement("a");
    cloneBtn.innerHTML = '<i class="icon-clone"></i>';
    cloneBtn.classList.add('blakejones-clone-btn', 'btn', 'btn-default');
    const cloneUrl = '/blakejones/clone-duplicate-static-page';
    cloneBtn.setAttribute('href', cloneUrl);
    controlToolbar.appendChild(cloneBtn);

    cloneBtn.addEventListener('click', e => {
        e.preventDefault();

        const pages = document.querySelectorAll('#PageList-pageList-page-list > ol li[data-item-path]');
        let addToUrl = [];

        pages.forEach(page => {
            let checkbox = page.querySelector('.checkbox > input[type="checkbox"]');

            if (checkbox.checked) {
                addToUrl = [
                    ...addToUrl,
                    page.dataset.itemPath
                ];
            }
        });

        if (addToUrl.length === 0) {
            alert("You didn't select any pages to be cloned. Click the checkboxes and try again.");
            return;
        }

        fetch(cloneUrl + '?ids=' + addToUrl.join('|||'))
        .then(response => response.json())
        .then(data => {
            data = JSON.parse(data);
            console.log(data);
            if (data?.status === "success") {
                alert("Pages cloned! Reload to see them. Be sure to save any changes, first.")
            } else {
                alert("There was an error cloning. Please report this issue to Blake.");
            }
        })
    })
}

window.addEventListener('load', () => addDuplicateSPBtn());
