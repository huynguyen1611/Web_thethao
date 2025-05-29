@extends('admin.main')
@section('content')
<form action="{{ route('admin.product.update') }}" enctype="multipart/form-data" method="post">
    @csrf
    <div class="admin-content-main-content">
        <div class="admin-content-main-content-left">
            <div class="admin-content-main-content-tow-input">
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="text" value="{{ $product -> name}}" name="name" placeholder="Tên sản phẩm" />
                <input type="text" value="{{ $product -> material }}" name="material" placeholder="Chất liệu" />
            </div>
            <div class="admin-content-main-content-tow-input">
                <input type="text" value="{{ $product -> price_nomal }}" name="price_nomal" placeholder="Giá bán" />
                <input type="text" value="{{ $product -> price_sale }}" name="price_sale" placeholder="Giá giảm" />
            </div>
            <textarea class="editor" name="description">{{ html_entity_decode($product->description) }}</textarea>
        <textarea class="editor1" name="content">{{ html_entity_decode($product->content) }}</textarea>

            <button type="submit" class="main-btn">Cập nhật sản phẩm</button>
        </div>

        <div class="admin-content-main-content-right">
            <div class="admin-content-main-content-right-img">
                <label for="image">Ảnh đại diện</label>
                <input id="image" type="file" name="image" value="{{ $product->image }}"/>
                <div class="image-show" id="input-file-img">
                    <img src="{{ asset($product->image) }}" alt="">
                </div>
            </div>
            <div class="admin-content-main-content-right-imgs">
                <label for="images">Ảnh sản phẩm</label>
                <input id="images" type="file" name="images[]" multiple />
                <div class="images-show" id="input-file-imgs">
                    @php
                        $product_images = explode('*', $product->images); // Chuyển chuỗi thành mảng
                    @endphp
                    @foreach ($product_images as $product_image) <!-- Sửa lại biến lặp là $product_images -->
                        <img src="{{ asset($product_image) }}" alt="">
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</form>

@endsection
@section('footer')
    <script src="{{asset('backend/asset/ckeditor/main.js')}}"></script>
    <script
      src="https://cdn.ckeditor.com/ckeditor5/45.0.0/ckeditor5.umd.js"
      crossorigin
    ></script>
    <script>
            const {
            ClassicEditor,
            Autoformat,
            AutoImage,
            Autosave,
            Base64UploadAdapter,
            BlockQuote,
            Bold,
            CodeBlock,
            Emoji,
            Essentials,
            GeneralHtmlSupport,
            Heading,
            ImageBlock,
            ImageCaption,
            ImageInline,
            ImageInsert,
            ImageInsertViaUrl,
            ImageResize,
            ImageStyle,
            ImageTextAlternative,
            ImageToolbar,
            ImageUpload,
            Indent,
            IndentBlock,
            Italic,
            Link,
            LinkImage,
            List,
            ListProperties,
            MediaEmbed,
            Mention,
            Paragraph,
            PasteFromOffice,
            Style,
            Table,
            TableCaption,
            TableCellProperties,
            TableColumnResize,
            TableProperties,
            TableToolbar,
            TextTransformation,
            TodoList,
            Underline,
        } = window.CKEDITOR;

        const LICENSE_KEY =
            "eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NDc4NzE5OTksImp0aSI6ImIzNTk1NzZkLTFkMzgtNGFiMS05ZTc1LTQ4ZGI5MTE0NzQxOCIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6IjhkMDdkNjEwIn0.hqBvOGxMlWdO3cn0ytUUGEE-l7APvLvkQrTDaPaWhXJP88XFA4Z0nFHekEwJ_fkSbME2xLSrs5WXm4YXNDEVoQ";

        const editorConfig = {
            toolbar: {
                items: [
                    "heading",
                    "style",
                    "|",
                    "bold",
                    "italic",
                    "underline",
                    "|",
                    "emoji",
                    "link",
                    "insertImage",
                    "mediaEmbed",
                    "insertTable",
                    "blockQuote",
                    "codeBlock",
                    "|",
                    "bulletedList",
                    "numberedList",
                    "todoList",
                    "outdent",
                    "indent",
                ],
                shouldNotGroupWhenFull: false,
            },
            plugins: [
                Autoformat,
                AutoImage,
                Autosave,
                Base64UploadAdapter,
                BlockQuote,
                Bold,
                CodeBlock,
                Emoji,
                Essentials,
                GeneralHtmlSupport,
                Heading,
                ImageBlock,
                ImageCaption,
                ImageInline,
                ImageInsert,
                ImageInsertViaUrl,
                ImageResize,
                ImageStyle,
                ImageTextAlternative,
                ImageToolbar,
                ImageUpload,
                Indent,
                IndentBlock,
                Italic,
                Link,
                LinkImage,
                List,
                ListProperties,
                MediaEmbed,
                Mention,
                Paragraph,
                PasteFromOffice,
                Style,
                Table,
                TableCaption,
                TableCellProperties,
                TableColumnResize,
                TableProperties,
                TableToolbar,
                TextTransformation,
                TodoList,
                Underline,
            ],
            heading: {
                options: [
                    {
                        model: "paragraph",
                        title: "Paragraph",
                        class: "ck-heading_paragraph",
                    },
                    {
                        model: "heading1",
                        view: "h1",
                        title: "Heading 1",
                        class: "ck-heading_heading1",
                    },
                    {
                        model: "heading2",
                        view: "h2",
                        title: "Heading 2",
                        class: "ck-heading_heading2",
                    },
                    {
                        model: "heading3",
                        view: "h3",
                        title: "Heading 3",
                        class: "ck-heading_heading3",
                    },
                    {
                        model: "heading4",
                        view: "h4",
                        title: "Heading 4",
                        class: "ck-heading_heading4",
                    },
                    {
                        model: "heading5",
                        view: "h5",
                        title: "Heading 5",
                        class: "ck-heading_heading5",
                    },
                    {
                        model: "heading6",
                        view: "h6",
                        title: "Heading 6",
                        class: "ck-heading_heading6",
                    },
                ],
            },
            htmlSupport: {
                allow: [
                    {
                        name: /^.*$/,
                        styles: true,
                        attributes: true,
                        classes: true,
                    },
                ],
            },
            image: {
                toolbar: [
                    "toggleImageCaption",
                    "imageTextAlternative",
                    "|",
                    "imageStyle:inline",
                    "imageStyle:wrapText",
                    "imageStyle:breakText",
                    "|",
                    "resizeImage",
                ],
            },
            initialData: "",
            licenseKey: LICENSE_KEY,
            link: {
                addTargetToExternalLinks: true,
                defaultProtocol: "https://",
                decorators: {
                    toggleDownloadable: {
                        mode: "manual",
                        label: "Downloadable",
                        attributes: {
                            download: "file",
                        },
                    },
                },
            },
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true,
                },
            },
            mention: {
                feeds: [
                    {
                        marker: "@",
                        feed: [
                            /* See: https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html */
                        ],
                    },
                ],
            },
            style: {
                definitions: [
                    {
                        name: "Article category",
                        element: "h3",
                        classes: ["category"],
                    },
                    {
                        name: "Title",
                        element: "h2",
                        classes: ["document-title"],
                    },
                    {
                        name: "Subtitle",
                        element: "h3",
                        classes: ["document-subtitle"],
                    },
                    {
                        name: "Info box",
                        element: "p",
                        classes: ["info-box"],
                    },
                    {
                        name: "CTA Link Primary",
                        element: "a",
                        classes: ["button", "button--green"],
                    },
                    {
                        name: "CTA Link Secondary",
                        element: "a",
                        classes: ["button", "button--black"],
                    },
                    {
                        name: "Marker",
                        element: "span",
                        classes: ["marker"],
                    },
                    {
                        name: "Spoiler",
                        element: "span",
                        classes: ["spoiler"],
                    },
                ],
            },
            table: {
                contentToolbar: [
                    "tableColumn",
                    "tableRow",
                    "mergeTableCells",
                    "tableProperties",
                    "tableCellProperties",
                ],
            },
        };
        const editorConfig1 = {
            ...editorConfig,
            placeholder: "Đặc điểm nổi bật...", // placeholder riêng cho .editor
            initialData: document.querySelector(".editor").value, // Dữ liệu ban đầu từ textarea
        };

        const editorConfig2 = {
            ...editorConfig,
            placeholder: "Mô tả sản phẩm...", // placeholder riêng cho .editor1
            initialData: document.querySelector(".editor1").value, // Dữ liệu ban đầu từ textarea
        };

        ClassicEditor.create(document.querySelector(".editor"), editorConfig1);
        ClassicEditor.create(document.querySelector(".editor1"), editorConfig2);


    </script>
    <script src="{{asset('backend/asset/js/product_ajax.js')}}"></script>
@endsection
