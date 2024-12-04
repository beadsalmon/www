/*
function movePage(select)
{
    if(select)
    {
        document.location.replace("?bo_table=" + g5_bo_table + "&select=" + select);
    }
    else
    {
        window.alert("이용할 수 없는 예약일자를 선택하였습니다.");
    }
    return;
}
*/

function all_checked(sw)
{
    var f = document.fboardlist;
    for(var i = 0; i < f.length; i++)
    {
        if(f.elements[i].name == "chk_wr_id[]") f.elements[i].checked = sw;
    }
    return;
}

function check_confirm(str)
{
    var f = document.fboardlist;
    var chk_count = 0;
    for(var i = 0; i < f.length; i++)
    {
        if(f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked) chk_count++;
    }
    if(!chk_count)
    {
        alert(str + "할 예약내역을 선택하세요.");
        return false;
    }
    return true;
}

function select_delete()
{
    var f = document.fboardlist;
    str = "취소";
    if(!check_confirm(str)) return;
    if(!confirm("선택한 예약내역을 정말로 "+str+"하시겠습니까?")) return;
    f.action = "./delete_all.php";
    f.submit();
}

function select_copy(sw)
{
    var f = document.fboardlist;
    if(sw == "copy") str = "복사";
    else str = "이동";
    if(!check_confirm(str)) return;
    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");
    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}

function selectFinish()
{
    var f = document.fboardlist;
    var str = "완료";
    if(!check_confirm(str)) return;
    if(!confirm("선택한 내역을 정말로 예약완료로 처리하시겠습니까?")) return;
    f.sw.value = "true";
    f.action = g5_bbs_skin_url + "/finish.control.php";
    f.submit();
}

function checkFinish(type, page)
{
    if(type == "T")
    {
        window.alert("해당내역은 이미 예약완료로 처리되었습니다.");
    }
    else
    {
        if(window.confirm("해당내역을 예약완료로 처리하시겠습니까?") == true)
        {
            document.location.replace(page);
        }
    }
    return;
}

function checkPrice(wr_id)
{
    var select = document.forms["fwrite"]["select"].value;
    var use = document.forms["fwrite"]["use[" + wr_id + "]"].value;
    var stay = document.forms["fwrite"]["stay[" + wr_id + "]"].value;
    var person = document.forms["fwrite"]["person[" + wr_id + "]"].value;

    if(use)
    {
        window.alert("선택하신 객실은 예약이 불가능합니다.");
        return false;
    }

/*    var request = create_request();
    request.onreadystatechange = function()
    {
        if(request.readyState == 4)
        {
            if(request.status == 200)
            {
                document.getElementById("price[" + wr_id + "]").innerHTML = request.responseText;
                checkTotal();
            }
            else
            {
                window.alert(request.status);
                window.alert("프로그램 오류가 발생하였습니다.");
            }
        }
    }

    request.open("post", g5_bbs_skin_url + "/check.ajax.php", true);
    request.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    request.send("bo_table=" + g5_bo_table + "&wr_id=" + wr_id + "&select=" + select + "&stay=" + stay + "&person=" + person);
    return;*/
    $.post(g5_bbs_skin_url + "/check.ajax.php", {bo_table:g5_bo_table, wr_id:wr_id, select:select, stay:stay, person:person}, function(obj){
    	document.getElementById("price[" + wr_id + "]").innerHTML = obj;
    	checkTotal();
    });
}

function checkTotal()
{
    var total = 0;
    var result = 0;
    var form = document.getElementById("mara_write");
    var max = form.length;
    for(var i = 0; i < max; i++)
    {
        if(form.elements[i].name == "room[]" && form.elements[i].checked == true)
        {
            var wr_id = form.elements[i].value;
            var price = document.getElementById("price[" + wr_id + "]").innerHTML.replace(/,/g, "");
            total += parseInt(price);
            result++;
        }
    }
    document.getElementById("total").innerHTML = getComma(total);
    return result;
}

function checkWrite()
{
    if(checkTotal() == 0)
    {
        window.alert("예약할 객실을 하나 이상 선택해주세요.");
        return false;
    }

    var phone = document.forms["fwrite"]["wr_homepage"].value.split("-");
    var pattern = /^[0-9]{3,4}-[0-9]{4}$/;
    var array = new Array("02", "031", "032", "033", "041", "042", "043", "051", "052", "053", "054", "055", "061", "062", "063", "064", "010", "011", "016", "017", "018", "019");
    var max = array.length;
    for(var i = 0; i < max; i++)
    {
        if(array[i] == phone["0"])
        {
            break;
        }
    }
    if(max == i || pattern.test(phone["1"] + "-" + phone["2"]) == false)
    {
        window.alert("연락처가 올바른 형식이 아닙니다.");
        document.forms["fwrite"]["wr_homepage"].focus();
        return false;
    }

    if(window.confirm("위의 선택정보로 예약을 진행하시겠습니까? ") == false)
    {
        return false;
    }
    return;
}

function getComma(string)
{
    var result = string.toString();
    var pattern = new RegExp("(-?[0-9]+)([0-9]{3})");
    for(var i = 0; i < 9; i++)
    {
        if(pattern.test(result))
        {
            result = result.replace(RegExp.$1, RegExp.$1 + ",");
        }
    }
    return result;
}