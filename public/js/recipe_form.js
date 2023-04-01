{
    const tagOption = document.querySelector('#options')
    function focusDropdownOptions() {
        document.getElementById("options").classList.toggle("hidden");
    }

    function setNewTag() {
        return fetch('/set_newtag', {
            method: 'GET'
        })
    }

    // get tag id by clicking tagname
    let tag_divs = document.querySelectorAll('#options div')
    tag_divs.forEach(tag_div => {
        tag_div.addEventListener('click', async () => {
            let tagId = tag_div.dataset.id
            let tagName = tag_div.textContent
            document.getElementById("tag_select").setAttribute('value', tagName)

            let response = await setNewTag()
            let newtags = (await response.json()).tags
            const tagNamesArray = newtags.map(item => item.name)
            const tagIdsArray = newtags.map(item => item.id)

            // 新たに取得したタグで総入れ替え
            for (let i = 0; i < tag_divs.length; i++) {
                tag_divs[i].textContent = tagNamesArray[i];
                tag_divs[i].dataset.id = tagIdsArray[i];
            }
            document.querySelector('#tag_id_post').setAttribute('value', tagId)
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
