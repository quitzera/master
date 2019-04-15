<form action="/addMaterial" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="title" id="" placeholder="标题"><br><br>
    <input type="text" name="describe" id="" placeholder="描述"><br><br>
    <input type="file" name="material" id=""><br><br>
    <input type="text" name="url" id="" placeholder="网页连接"><br><br>
    <input type="submit" name="" id="" value="上传">
</form>