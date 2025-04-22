<form action="/upload" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="file">Choose a file to upload</label>
    <input type="file" name="file" id="file" required>
    <button type="submit">Upload</button>
</form>
