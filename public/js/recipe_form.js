{
    function focusDropdownOptions() {
        document.getElementById("options").classList.toggle("hidden");
    }


    // get tag id by clicking tagname
    tagNames = document.querySelectorAll('#options div')

    tagNames.forEach(tag_div => {
        tag_div.addEventListener('click', () => {
            console.log(67)
            tagId = tag_div.dataset.id
            tagName = tag_div.textContent
            // tagId = e.target.dataset.id
            document.querySelector('#tag_id_post').setAttribute('value', tagId)
            document.getElementById("options").classList.toggle("hidden");
            document.getElementById("tag_select").setAttribute('value', tagName)
        })
    })

    // tag select blur
    // document.querySelector('#tag_select').addEventListener('blur', (e) => {
    // document.querySelector('#tag_select').addEventListener('click', (e) => {

    // })

    const specifiedElement = document.querySelector('#tag_select')
    document.addEventListener('click', event => {
        const isClickInside = specifiedElement.contains(event.target)

        if (!isClickInside) {
          // The click was OUTSIDE the specifiedElement, do something
            document.getElementById("options").classList.toggle("hidden")

          console.log(isClickInside)
        }
      })



}
