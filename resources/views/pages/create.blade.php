@extends('layouts.admin')
@section('header', 'Create Page')
@section('content')
    <div>
        <form id="page-form" action="{{ route('pages.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-forms.input name='title' label="Title" star />
                </div>
                <div class="col-md-6">
                    <x-forms.input name='slug' label="Slug" star />
                </div>
                <div class="col-12">
                    <div id="gjs"></div>
                </div>
            </div>
            <!-- Hidden Input to Store GrapesJS Content -->
            <input type="hidden" name="html" id="html-content" />
            <button type="button" id="submit-btn" class="btn btn-primary my-2">Submit</button>
        </form>
    </div>
@endsection

<x-snippets.grape />

@push('scripts')
    <script>
        let editor; // Declare editor in global scope

        document.addEventListener('DOMContentLoaded', () => {
            editor = grapesjs.init({
                container: '#gjs',
                height: '600px',
                storageManager: false,
                showOffsets: true,
                fromElement: true,
                parser: {
                    optionsHtml: {
                        allowScripts: true,
                    },
                },
                canvas: {
                    styles: [
                        'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css',
                        'https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css',
                        'https://use.fontawesome.com/releases/v6.7.2/css/all.css',
                    ]
                },
                plugins: [
                    'grapesjs-blocks-bootstrap4',
                    'grapesjs-tailwind',
                    'grapesjs-plugin-export',
                    'grapesjs-preset-webpage',
                    'grapesjs-custom-code',
                    'grapesjs-navbar',
                    'grapesjs-blocks-flexbox',
                    'grapesjs-component-countdown',
                    'grapesjs-component-code-editor',
                    'grapesjs-script-editor',
                ],
            });

            const pn = editor.Panels;
            const panelViews = pn.addPanel({
                id: "views"
            });
            panelViews.get("buttons").add([{
                attributes: {
                    title: "Open Code"
                },
                className: "fa fa-file-code-o",
                command: "open-code",
                togglable: false,
                id: "open-code"
            }]);

            // Trigger form submission only after applying HTML
            document.querySelector('#submit-btn').addEventListener('click', function() {
                if (editor) {
                    const htmlContent = editor.getHtml();
                    const cssContent = editor.getCss();

                    const completeHTML = '<style>' + cssContent + '</style>' + htmlContent
                    document.querySelector('#html-content').value = completeHTML;

                    console.log('Form Submitted with HTML:', completeHTML); // Debugging log
                    // Trigger form submission manually
                    document.querySelector('#page-form').submit();
                } else {
                    console.error('Editor is not initialized');
                }
            });
        });
    </script>
@endpush
