{

    authed_userid_div = document.querySelector('#nowuserid')

    userids = document.querySelectorAll('.user-id')

    let nowuserid = authed_userid_div.dataset.nowuserid

    // なぜかここが動かない。2/20/2023
    userids.forEach(userid => {
        userid.addEventListener('click', (event) => {
            console.log('ukj')
            event.target.style.color = "blue"
        })
    })
}
