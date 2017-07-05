
$(document).ready(function(){
    $('#selectAllBox').on('click', function(event){
        if(this.checked) {
            $('.checkBoxes').each(function(){
                this.checked = true;
            })
        }else {
            $('.checkBoxes').each(function(){
                this.checked = false;
            })
        }
    })
})
