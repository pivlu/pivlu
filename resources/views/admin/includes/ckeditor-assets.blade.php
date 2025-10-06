<!-- editor -->
<script src="{{ asset('assets/vendor/ckeditor/ckeditor5/ckeditor5.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/vendor/ckeditor/ckeditor5/ckeditor5.css') }}">

<style>
    #ckeditor {
        min-height: 300px;
    }
</style>

<script type="importmap">
	{
		"imports": {
			"ckeditor5": "{{ asset('assets/vendor/ckeditor/ckeditor5/ckeditor5.js') }}",
			"ckeditor5/": "{{ asset('assets/vendor/ckeditor/ckeditor5/') }}"
		}
	}
</script>

<script type="module">
    import {
        ClassicEditor,
        Alignment,
        Autoformat,
        Bold,
        Italic,
        Underline,
        BlockQuote,
        Code,
        CodeBlock,
        Essentials,
        Fullscreen,
        Heading,
        Highlight,
        HorizontalLine,
        Link,
        List,
        Paragraph,
        SourceEditing,
        Table,
        TableColumnResize,
        TableToolbar,
        TextTransformation,
    } from 'ckeditor5';

    ClassicEditor
        .create(document.querySelector('#ckeditor'), {
            licenseKey: 'GPL',
            plugins: [Autoformat,
                Alignment,
                BlockQuote,
                Bold,
                Code,
                CodeBlock,
                Essentials,
                Fullscreen,
                Heading,
                Highlight,
                HorizontalLine,
                Italic,
                Link,
                List,
                Paragraph,
                SourceEditing,
                Table,
                TableColumnResize,
                TableToolbar,
                TextTransformation,
                Underline,
            ],
            toolbar: [
                'undo',
                'redo',
                '|',
                'heading',
                '|',
                'bold',
                'italic',
                'underline',
                'alignment',
                '|',
                'link',
                'insertTable',
                'blockQuote',
                'highlight',
                'horizontalLine',
                '|',
                'bulletedList',
                'numberedList',
                'code',
                'codeBlock',
                'sourceEditing',
                'fullscreen'
            ],
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                ]
            },
            codeBlock: {
                languages: [{
                        language: 'html',
                        label: 'HTML'
                    },
                    {
                        language: 'css',
                        label: 'CSS'
                    },
                    {
                        language: 'javascript',
                        label: 'JavaScript'
                    },
                    {
                        language: 'python',
                        label: 'Python'
                    },
                    {
                        language: 'php',
                        label: 'PHP'
                    },
                    {
                        language: 'xml',
                        label: 'XML'
                    }
                ]
            },
            menuBar: {
                isVisible: true
            }
        })
        .then(editor => {
            window.editor = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script>
