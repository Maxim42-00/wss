<!DOCTYPE html>

<html>

<head>
    <title>Rachet</title>
    <meta charset="utf-8" />
</head>

<body>
    <form action="">
        <div> Имя: <input type="text" name="name" id="name" /> </div>
        <div> Текст: <input type="text" name="msg" id="msg" /> </div>
        <div> <input type="button" id="send" value="send" /> </div>
        <div id="status"> </div>
    </form>

    <script>

window.onload=function()
{
    const socket=new WebSocket("wss://astro-margo.ru:8090");
    let status=document.querySelector("#status");

    socket.onopen=function(event)
    {
        status.innerHTML="Соединение установлено"+"<br />";
    }

    socket.onerror=function(event)
    {
        status.innerHTML="Ошибка "+event.message+"<br />";
    }

    socket.onclose=function(event)
    {
        if(event.wasClean)
             status.innerHTML="Соединение закрыто чисто"+"<br />";
        else
             status.innerHTML="Соединение прервано"+"<br />";
    }

    socket.onmessage=function(event)
    {
        status.innerHTML+="Входящее сообщение: "+event.data+"<br />";
    }

    document.querySelector("#send").addEventListener("click", ()=>{
        let message={
            name: document.querySelector("#name").value,
            msg: document.querySelector("#msg").value
        };
        socket.send(JSON.stringify(message));
    });
}

    </script>
</body>

</html>