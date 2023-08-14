<div class="modal fade" id="updateParagraphModal" tabindex="-1" role="dialog" aria-labelledby="updateParagraphModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('admin.paragraph-contents.custom-update') }}" class="d-flex" id="update-ajax-form" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> Edit Paragraph Content </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="Id">
                    <input type="hidden" name="feild_name" id="feildName">
                    <div class="content" style="width: 700px !important;" id="plainText">
                    </div>
                    {{-- <div class="content-rich " id="richText">
                        <div id="content-holder">
                            <div id="toolbar-container"></div>
                            <div id="txt_area">
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="modal-footer text-right">
                    <button type="submit" class="btn btn-primary" id="update-paragraph" >Save</button>
                </div>
            </div>
        </form>
    </div>
</div>