
function submitRating() {

    var reason = $.trim($('#work_desc').val());
    var manager_id = $(".gallery__item--active").attr('id');
    if (manager_id != undefined) {

        manager_id = manager_id.split('_');
        manager_id = manager_id[1];
        var user_id = $('#user_id').val();
        var for_id = user_id;
    } else {
        var manager_id = $('#leadId').val();
        var user_id = $('#user_id').val();
        var for_id = $('#for_id').val();
    }
    if (!reason)
    {
        $('#error').html('Please provide appropriate reason for your rating request.');
        $('#error').removeClass('error')
        $('#error').addClass('errMsg-red');
        $('#error').show();
        $('#close').show();
        return false;

    }

    if (manager_id == undefined || user_id == undefined || !manager_id.trim())
    {
        $('#error').html('No Lead is assigned to this member.');
        $('#error').removeClass()
        $('#error').addClass('errMsg-green');
        $('#error').show();
        $('#close').show();

        return false;
    }

    $.ajax({
        url: 'ajax_request.php',
        type: 'POST',
        beforeSend: function (xhr) {
            $(".ajaxLoader").show();
            $('.overlay').show();
        },
        data: {"action": "tm_rating_request", "lead_id": manager_id, "user_id": user_id, "for_id": for_id, "rating": '1', "work_desc": reason},
        success: function (response) {
            $(".ajaxLoader").hide();
            $('.overlay').hide();
            $('#work_desc').val('');
            $('#error').html('Your request is sent !');
            $('#error').removeClass();
            $('#error').addClass('errMsg-green');
            $('#error').show();
            $('#close').show();
            location.reload();
        }
    });

}

function getMemberByAlphabets(char) {
    $('.a-down').css('background', '').css('color', 'black');
    $('#' + char).css('background', 'red').css('color', 'white');
    $("#serachMember").val('');
    $.ajax({
        url: 'dashboard.php',
        type: 'GET',
        beforeSend: function (xhr) {
            $(".ajaxLoader").show();
            $('.overlay').show();
        },
        data: {'char': char, 'action': 'getMemberByAlphabets'},
        success: function (response) {
            $(".ajaxLoader").hide();
            $('.overlay').hide();
            $('#mCSB_1_container').html(response);
//            $(".div-team-lft-txt .name").removeAttr("text-decoration").css('font-weight', 'none');
        }
    });

}

function searchMemberByKeyword(searchKeyword) {
    $('.a-down').css('background', '').css('color', 'black');
    if (searchKeyword != '') {


        $.ajax({
            url: 'dashboard.php',
            type: 'GET',
            sync: "true",
            data: {'searchKeyword': searchKeyword, 'action': 'getMemberBySearchKeyword'},
            success: function (response) {

                $('#mCSB_1_container').html(response);
            }
        });

    }
    else {

        $.ajax({
            url: 'dashboard.php',
            type: 'GET',
            data: {'char': 'All', 'action': 'getMemberByAlphabets'},
            success: function (response) {

                $('#mCSB_1_container').html(response);
            }
        });

    }
}

function getMemberDetails(val) {


    $('#rateMe').html('Rate Team Member');
    $('#error').hide();
    $.ajax({
        url: 'dashboard.php',
        type: 'GET',
        beforeSend: function (xhr) {
            $(".div-team-lft-txt .name").css("text-decoration", "none").css('font-weight', 'none');
        },
        data: {'memberId': val, 'action': 'getMemberDetails'},
        success: function (response) {
            $('.div-team-lft-txt #' + val).css("text-decoration", "underline").css('font-weight', 'bold');
            $('.mid-col-4-new').html(response);

        }
    });
}

function rateTeamMember(for_id) {
    var reason = $.trim($('#work_desc').val());
    var user_id = $('#user_id').val();

    if (!reason)
    {
        $('#error').html('Please provide appropriate reason for your rating request.');
        $('#error').removeClass('error')
        $('#error').addClass('errMsg-red');
        $('#error').show();
        $('#close').show();
        return false;
    }
    if (user_id == undefined || user_id == '' || for_id == undefined || for_id == '')
    {
        $('#error').html('Problem in rating .');
        $('#error').removeClass('error')
        $('#error').addClass('errMsg-red');
        $('#error').show();
        $('#close').show();
        return;
    }
    $.ajax({
        url: 'dashboard.php',
        type: 'GET',
        beforeSend: function (xhr) {
            $(".ajaxLoader").show();
            $('.overlay').show();
        },
        data: {"action": "rate_team_mem_plus", "user_id": user_id, "for_id": for_id, "rating": '1', "work_desc": reason},
        success: function (response) {
            if ($.trim(response) == 'success') {
                $(".ajaxLoader").hide();
                $('.overlay').hide();
                $('#work_desc').val('');
                $('#error').html('User rated successfully !');
                $('#error').removeClass();
                $('#error').addClass('errMsg-green');
                $('#error').show();
                $('#close').show()
                location.reload();
            }

        }
    });
}

$(document).ready(function () {

    $('#close').click(function () {
        $('#error').hide();
        $('#close').hide();


    });

    $("#serachMember").keydown(function ()
    {
        setTimeout(function () {
            searchMemberByKeyword($("#serachMember").val());
        }, 3000);

    }
    );

    $(document).on('click', '.name', function () {

        $(this).css("text-decoration", "underline").css('font-weight', 'bold');
    });

    $(document).on('click', '.div-team-lft-img a', function () {

        $(".div-team-lft-txt .name").css("text-decoration", "none").css('font-weight', 'none');
        $('.div-team-lft-txt #' + $(this).attr('id') + '.name').css("text-decoration", "underline").css('font-weight', 'bold');
    });
});
