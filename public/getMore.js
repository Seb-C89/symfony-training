async function getMore(lastid, element){
    const res = await fetch("http://127.0.0.1:8000/api/post/"+lastid)
        .then(async res => await res.json())
        .catch(e => { element.disabled = true })

    const numberOfChildBeforeInsert = element.parentElement.childElementCount
    if(res)
        element.insertAdjacentHTML("beforebegin", res.posts);
    const insertedElement = element.parentElement.childElementCount - numberOfChildBeforeInsert

    if(insertedElement === 5)
        element.dataset.lastid = res.lastid;
    else
        element.disabled = true;
}