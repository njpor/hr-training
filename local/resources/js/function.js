
var siteURL = '/jd_por';  //เปลี่ยนชื่อตามชื่อ project

var TitleSwalAdd = 'บันทึกข้อมูล?';
var TextSwalAdd = 'คุณต้องการบันทึกข้อมูลหรือไม่ !';
var IconAdd = 'warning';

var SwalAdd = {
    title: 'บันทึกข้อมูล?',
    text: "คุณต้องการบันทึกข้อมูลหรือไม่ !",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'บันทึก',
    cancelButtonText: 'ยกเลิก'
};


function loading()
{
    swal.fire({
        text: "กำลังโหลด กรุณารอสักครู่",
        imageUrl: siteURL+ "{{asset('assets/images/loading.gif')}}",
        showConfirmButton: false,
        allowOutsideClick: false
    })


}
function success()
{
    Swal.fire(
        'บันทึกข้อมูลสำเร็จ',
        'บันทึกข้อมูลเรียบร้อยแล้ว.',
        'success'
    )
}
function success_save()
{
    Swal.fire(
        'บันทึกข้อมูลสำเร็จ',
        'บันทึกข้อมูลเรียบร้อยแล้ว',
        'success'
    )
}

function success_del()
{
    Swal.fire(
        'ลบข้อมูลสำเร็จ',
        'บันทึกการลบข้อมูลเรียบร้อยแล้ว',
        'success'
    )
}

function success_send()
{
    Swal.fire(
        'ส่งข้อมูลสำเร็จ',
        'ส่งข้อมูลเรียบร้อยแล้ว',
        'success'
    )
}
function success_reject()
{
    Swal.fire(
        'ส่งข้อมูลให้แก้สำเร็จ',
        'ส่งข้อมูลเรียบร้อยแล้ว',
        'success'
    )
}
function success_approve()
{
    Swal.fire(
        'อนุมัติสำเร็จ',
        'อนุมัติเป้าหมายเรียบร้อยแล้ว',
        'success'
    )
}
function error()
{
    Swal.fire(
        'ระบบขัดข้อง',
        'กรุณาติดต่อผู้ดูแลระบบ !',
        'error'
    )
}
// ---------- นับจำนวนในตาราง จากชื่อ class -------//
function count_row(data) {
    var x = 0;
    $("."+data).each(function() {
        x++;
    });
    return x;
}


function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if ( (charCode > 31 && charCode < 48) || charCode > 57) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })
          Toast.fire({
            icon: 'warning',
            color: '#FFFFFF',
            background: '#EF8B13',
            title: 'กรุณากรอกตัวเลขเท่านั้น !'
          })
          return false;
    }
    return true;
}

var weightsum = 100;
function weightFunction(nameclass,nameshow) {
    weightsum = 0;
    var sum = 0;
    $('.'+nameclass).each(function(){
        var w = 0;
        if(this.value == null || this.value == '')
        {
            w = 0;
        }
        else
        {
            w = this.value;
        }
        sum += parseFloat(w);
    });
    if(sum > 100)
    {
        $('#'+nameshow).html('<span style="color: brown">'+sum+'</span>');
        weightsum = sum;
    }
    else
    {
        $('#'+nameshow).html('<span style="color: darkgreen">'+sum+'</span>');
        weightsum = sum;
    }
}



function weightsumFunction(nameclass) {
    weightsum = 0;
    var sum = 0;
    $('.'+nameclass).each(function(){
        var w = 0;
        if(this.value == null || this.value == '')
        {
            w = 0;
        }
        else
        {
            w = this.value;
        }
        sum += parseFloat(w);
    });
    return sum;
}


    function filerecordinglocation(set,position ){
        var filelocation = 'file_'+set
        +'_recording/file_'+set
        +'_'+position
        +'/';
        return filelocation;
    }
    function Swalwarning(text)
    {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            Toast.fire({
                icon: 'warning',
                color: '#FFFFFF',
                background: '#EF8B13',
                title: text
        })
    }
    function formetdate(data)
    {
        var formattedDate = new Date(data);
        var d = formattedDate.getDate();
        var m =  formattedDate.getMonth();
        m += 1;  // JavaScript months are 0-11
        var y = formattedDate.getFullYear();
        var d_v = '';
        var m_v = '';
        if(d <10)
        {
            d_v = "0"+d;
        }
        else
        {
            d_v = d;
        }
        if(m <10)
        {
            m_v = "0"+m;
        }
        else
        {
            m_v = m;
        }
        var value = d_v + "-" + m_v + "-" + y;
        return value;
    }
