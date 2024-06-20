async function getMore(lastid, element){
    const numberOfChildBeforeInsert = element.parentElement.childElementCount
    const res = await fetch("http://localhost:8000/api/post/"+lastid).then(async res => await res.json()).catch(e => element.disabled = true)

    console.log(res)

    element.insertAdjacentHTML("beforebegin", res.posts);

    const insertedElement = element.parentElement.childElementCount - numberOfChildBeforeInsert
    if(insertedElement === 5)
        element.dataset.lastid = res.lastid;
    else
        element.disabled = true;

    console.log("Inserted elements: ", insertedElement)
}