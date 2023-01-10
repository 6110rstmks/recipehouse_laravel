const ul = document.querySelector('ul');
const purgeCategory = document.querySelector('.purge-category');
const checkboxes = document.querySelectorAll('input[type="checkbox"]');
const deletes = document.querySelectorAll('.delete');
const uptos = document.querySelectorAll('.upChange');
const downtos = document.querySelectorAll('.downChange');
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const addTitle = document.querySelector('.title-input');
const updateTitles = document.querySelectorAll('.title-update');

const noLi = document.createElement('li');
noLi.textContent = 'No posts yet!'

addTitle.focus();

// function addTodo(id, titleValue) {

//     const li = document.createElement('li');
//     li.dataset.id = id;

//     const titleContainer = document.createElement('div');
//     titleContainer.classList.add('title-container');

//     const title = document.createElement('span');
//     title.textContent = titleValue;

//     const deleteSpan = document.createElement('span');
//     deleteSpan.textContent = 'delete';
//     deleteSpan.classList.add('delete');


//     li.appendChild(titleContainer);


//     const ul = document.querySelector('.category-ul');
//     ul.insertBefore(li, ul.firstChild);

//   }

/* ------------ajax---------------- */

purgeCategory.addEventListener('click', () => {

    if (!confirm('Are you sure?')) {
        return;
    }
    fetch('/posts/purge', {
        method: 'DELETE',
        headers: {
            'X-CSRF-Token': token,
        }
    })

    const lis = document.querySelectorAll('li');
    lis.forEach(li => {
        li.remove();
    });
    ul.insertBefore(noLi, ul.firstChild);
})

/*ajax delete*/

deletes.forEach(span => {
    const postid = span.dataset.id;
    span.addEventListener('click', () => {

        fetch('/posts/'+ postid + '/destroy', {
            method: 'DELETE',
            headers: {
                'X-CSRF-Token': token,
            }
        });

        span.parentNode.parentNode.remove();
        const count = ul.childElementCount;

        if (count == 0) {
            ul.insertBefore(noLi, ul.firstChild);
        }
    })
});


/** ajax add category */

document.querySelector('.add-form').addEventListener('submit', e => {
    e.preventDefault();

    const title = addTitle.value;

    fetch('/posts/store', {
      method: 'POST',
      headers: {
        'X-CSRF-Token': token,
      },
      body: new URLSearchParams({
        title: title,
      }),
    })

    .then(response => response.json())

    .then(json => {
      addTodo(json.id, title);
    });

    addTitle.value = '';
    addTitle.focus();
})

/* ajax update category_name */

updateTitles.forEach(updateTitle => {
    const postid = updateTitle.dataset.id;

    updateTitle.addEventListener('keypress', e => {
        if (e.keyCode === 13) {
            const title = updateTitle.value;

            fetch('/posts/' + postid + '/update', {
                method: 'PATCH',
                headers: {
                    'X-CSRF-Token': token,
                },
                body: new URLSearchParams({
                    title: title,
                }),
            })

        }
    })

    updateTitle.addEventListener('blur', () => {
        console.log('conmp');
        updateTitle.style.cursor = 'context-menu';
        const title = updateTitle.value;

        fetch('/posts/' + postid + '/update', {
            method: 'PATCH',
            headers: {
                'X-CSRF-Token': token,
            },
            body: new URLSearchParams({
                title: title,
            }),
        })

    })

    updateTitle.addEventListener('click', e => {
        updateTitle.style.cursor = 'text';
    })
})


/* ------------------- up to here ajax coverage area ------------------- */

