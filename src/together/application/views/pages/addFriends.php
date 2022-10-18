<div id="header">
    <h1 class="title"><?= $title ?></h1>
    <div class="user-btn">
        <div><a href="#"><i class="material-icons" id="user-icon">person</i></a></div>
    </div>
</div>

<div class="search bar">
    <form>
        <input placeholder="Please input..." name="cname" tyoe="text">
        <button type="submit"></button>
    </form>
</div>
<div class="description">People you may know</div>

<style>
* {
    box-sizing:border-box;
    font-size:10px;
}

.description{
    padding-left: 30px;
    font-size:3rem;
}

div.search {
    padding:10px 0;
    padding-top: 35px;

}

form {
    position:relative;
    width:80%;
    margin:0 auto;
}

input,button {
    border:none;
    outline:none;
}

input {
    width:100%;
    height:72px;
    padding-left:13px;
}

button {
    height:72px;
    width:10%;
    cursor:pointer;
    position:absolute;
}    

.bar input {
    border:2px solid #c5464a;
    border-radius:0.5ch;
    background:transparent;
    top:0;
    right:0;
}

.bar button {
    background:#c5464a;
    border-top-right-radius: 1ch;
    border-bottom-right-radius: 1ch;
    width:100px;
    top:0;
    right:0;
}

.bar button:before {
    content:"Search";
    font-size:28px;
    color:#F9F0DA;
}
</style>
