<!-- Message Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('user.send.message')}}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{auth()->id()}}">
                    <div class="form-groum">
                        <label for="">To</label>
                        <select list="businesses" class="form-control" name="business_id" id="business-name">

                        </select>
                    </div>
                    <div class="form-groum">
                        <label for="">Subject</label>
                        <input type="text" class="form-control" name="subject">
                    </div>
                    <div class="form-groum">
                        <label for="">Message</label>
                        <textarea name="message" id="" class="form-control" cols="30" rows="3"></textarea>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $("#business-name").one('focus', function() {
        $.ajax({
            type: 'POST',
            url: '{{route('get.businesses')}}',
            data: {'_token': '{{csrf_token()}}'},
            success:function(data) {
                
                if(data.error == false) {
                    // console.log(data);
                    option = '';
                    $.each(data.data, function(index, value){
                        option += '<option value="'+value.id+'">'+value.name+'</option>';
                        console.log(value.name);
                    });
                    // console.log(option);
                    $("#business-name").append(option);
                }
            }
        })
    });
</script>