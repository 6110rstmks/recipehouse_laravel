{

    authed_userid_div = document.querySelector('#nowuserid')

    userids = document.querySelectorAll('.user_id')

    let nowuserid = authed_userid_div.dataset.nowuserid

    userids.forEach(userid => {
        userid.addEventListener('click', (event) => {

            if (userid.dataset.userid !== nowuserid)
            {
                event.target.style.color = "blue"

                if (!confirm("ポイントを消費しますがよろしいですか？"))
                {
                    event.preventDefault()
                }
            }

        })
    })
}
