{
    const tagOption = document.querySelector('#options')
    function focusDropdownOptions() {
        document.getElementById("options").classList.toggle("hidden");
    }

    function setNewTag() {
        fetch('/set_newtag', {
            method: 'GET'
        })
        .then(response => {
            return response.json()
        })
        .then(json => {
            while (tagOption.firstChild) {
                tagOption.removeChild(document.querySelector('#options').firstChild)
            }

            const newtags = json.tags
            newtags.forEach(newtag => {
                console.log(newtag)
                const divTag = document.createElement("div")
                divTag.textContent = newtag.name
                divTag.setAttribute("data-id", newtag.id)
                divTag.classList.add("px-1", "py-1", "text-gray-800", "hover:bg-indigo-500", "hover:text-white")
                tagOption.append(divTag)
            })

        })
    }

    // get tag id by clicking tagname
    let tagNames = document.querySelectorAll('#options div')
    tagNames.forEach(tag_div => {
        tag_div.addEventListener('click', () => {
            let tagId = tag_div.dataset.id
            let tagName = tag_div.textContent
            setNewTag()
            document.querySelector('#tag_id_post').setAttribute('value', tagId)
            document.getElementById("tag_select").setAttribute('value', tagName)

        })
    })

    const tagList = document.querySelector('#tag_select')
    document.addEventListener('click', event => {

        const withBoundaries = event.composedPath().includes(tagList)

        if (!withBoundaries) {
          // The click was OUTSIDE the specifiedElement, do something
            tagOption.classList.add("hidden")
        }
      })

}
