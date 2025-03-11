@extends('master.admin')
@section('title', 'Create new a Blog')
@section('main')


<div class="row">
    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-9">

            <div class="form-group">
                <label for="">Blog Url</label>
                <input type="text" name="blog_url" class="form-control" id="blog_url" placeholder="Input field" value="{{old('name')}}">
                @error('name')
                <small>{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Blog name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Input field" value="{{old('name')}}">
                @error('name')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Blog Link</label>
                <input type="text" name="link" class="form-control" id="link" placeholder="Input field" value="{{old('link')}}">
                @error('link')
                <small>{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Blog Desscription</label>
                <textarea name="description" id="description" class="form-control description" placeholder="Blog content">{{old('description')}}</textarea>
                @error('description')
                <small>{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Blog Position</label>
                <input type="text" name="position" class="form-control" id="position" placeholder="Input field" value="{{old('position')}}">
                @error('position')
                <small>{{$message}}</small>
                @enderror
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="status" value="1" {{old('status') == 1 ? 'checked' : ''}} />
                    Publish
                </label>
            </div>

            <div class="radio">
                <label>
                    <input type="radio" name="status" value="0" {{old('status') == 0 ? 'checked' : ''}} />
                    Hidden
                </label>
            </div>
            <div class="form-group">
                <label for="">Blog Image</label>
                <input type="file" name="img" id="img" class="form-control" onchange="showImage(this)">
                <input type="text" hidden id="image" name="image" placeholder="Nhập URL ảnh">
                <img src="" id="show_img" alt="" width="100%">
            </div>
            <!-- <div id="imagePreview" style="margin-top: 20px;">
                <h3 style="color: white;">Ảnh từ bài viết:</h3>
                <img id="previewImage" src="" alt="Image Preview" style="max-width: 100%; height: auto; display: none;">
            </div> -->
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </div>
    </form>
</div>


@stop()


@section('css')
<link rel="stylesheet" href="ad_assets/plugins/summernote/summernote.min.css">
@stop()

@section('js')
<script src="ad_assets/plugins/summernote/summernote.min.js"></script>
<script>
    $('.description').summernote({
        height: 250
    });

    function showImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#show_img').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script>
    $('#blog_url').on('input', function() {
        const url = $(this).val();
        const proxyUrl = "";

        if (url) {
            // Gửi yêu cầu lấy nội dung trang
            fetch(url)
                .then(response => response.text())
                .then(data => {
                    // Tạo DOM từ nội dung HTML trả về
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(data, 'text/html');

                    // Lấy tiêu đề từ thẻ <h1>
                    const title = doc.querySelector('h1') ? doc.querySelector('h1').innerText : '';

                    // Lấy tất cả nội dung từ các thẻ <p>
                    const paragraphs = Array.from(doc.querySelectorAll('p')).map(p => p.innerText).join('\n');

                    // Tìm ảnh đầu tiên có trong nội dung hoặc ảnh có alt gần giống với tiêu đề
                    let image = '';
                    const imgTags = doc.querySelectorAll('img');

                    console.log(imgTags);

                    // Tìm ảnh có alt gần giống với tiêu đề 
                    imgTags.forEach(img => {
                        if (!image && img.alt && img.alt.toLowerCase().includes(title.toLowerCase())) {
                            image = img.dataset.src;
                            console.log(img.alt);
                        }
                    });

                    // Nếu không tìm thấy ảnh với alt gần giống, lấy ảnh đầu tiên trong nội dung
                    if (!image && imgTags.length > 0) {
                        image = 'không tìm thay ảnh có alt gần giống với tiêu đề';
                    }

                    if (image) {
                        image = proxyUrl + image;
                    }

                    // Điền dữ liệu vào các ô trong form
                    $('#name').val(title);
                    $('#description').summernote('code', paragraphs);
                    $('#image').val(image || '');  // Đảm bảo có giá trị để tránh lỗi
                    $('#link').val( url || ''); // Hiển thị ảnh
                    $('#position').val('top-banner');


                    console.log('Tiêu đề:', title);
                    console.log('Nội dung:', url);
                    console.log('Ảnh:', image);


                    // Hiển thị ảnh preview
                    if (image) {
                        $('#previewImage').attr('src', image);
                        $('#previewImage').show(); // Hiển thị ảnh
                    }
                })
                .catch(error => {
                    console.log('Có lỗi xảy ra:', error);
                });
        }
    });
</script>
@stop()