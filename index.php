<?php
    include_once "prefix.php";
    include_once "connection.php";
    include_once "common.php";
    include_once "jsdb.php";
    include_once "jsdom.php";
    include_once "jsdomelement.php";
    include_once "jsencoding.php";
    include_once "jsform_new.php";
    include_once "jsform.php";
    include_once "jsmodalelement.php";
    include_once "menu.php";
    include_once "jsbootstrap.php";
    include_once "style_kpi.php";
    include_once "content_module.php";
    include_once "jsbutton_071218.php";
    include_once "bsc2kpi_111218.php";
    include_once "newlogin.php";
    include_once "blackTheme.php";
    include_once "reporter_survey.php";
    include_once "reporter_survey_information.php";
    include_once "reporter_survey_perform.php";
    include_once "reporter_survey_perform_information.php";
    include_once "reporter_type_survey.php";
    include_once "reporter_type_survey_information.php";
    include_once "reporter_record.php";
    include_once "reporter_record_information.php";
    include_once "reporter_feedback.php";
    include_once "reporter_feedback_information.php";
    include_once "reporter_examinations.php";
    include_once "reporter_examinations_information.php";
    include_once "reporter_examinations_perform.php";
    include_once "reporter_examinations_perform_information.php";
    include_once "reporter_feedback_examinations.php";
    include_once "reporter_feedback_examinations_information.php";
    include_once "reporter_user_examinations.php";
    include_once "reporter_user_examinations_information.php";
    include_once "languagemodule.php";
    include_once "./old_php/reporter_users.php";
    include_once "./old_php/reporter_users_information.php";

    LanguageModule_load("FORM",$prefix."uitext");
        if (isset($_SESSION[$prefixhome."language"])) {
            $LanguageModule_v_defaultcode = $_SESSION[$prefixhome."language"];
        }
    session_start();
    $add =  $_SERVER['REQUEST_URI'];
    $protocal =  isset($_SERVER['HTTPS'])? "https://":"http://";
    $temp = substr($add, 1);
    $temp2 = strpos($temp, "/");
    if (!isset($_SESSION[$prefixhome."userid"])) {
        $x = $_SERVER['SERVER_NAME']."/".substr($temp, 0, $temp2)."?id=".substr($temp,$temp2+1);
        header("Location:".$protocal.$x);
        exit();
    }
    $conn = DatabaseClass::init($host, $username , $password, $dbname);
    $result = $conn->load($prefix."users", "homeid = ".$_SESSION[$prefixhome."userid"]);
    if ((count($result) == 0)){
        $_SESSION[$prefix.'userid'] = 0;
        $x = $_SERVER['SERVER_NAME']."/".substr($temp, 0, $temp2);
        $pfid = 0;
    }
    else {
        $_SESSION[$prefix.'userid'] = $result[0]['id'];
        $_SESSION[$prefix.'privilege'] = $result[0]['privilege'];
        $x = $_SERVER['SERVER_NAME']."/".substr($temp, 0, $temp2);
    }

    ?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <style>
        .bodyFrm .resetClass {
            font-size: inherit;
        }
        </style>
        <script src="absol/absol_full.js?timestamp=<?php  echo stat('absol/absol_full.js')['mtime'];?>"></script>
        <script src="js/FormatFunction.js?timestamp=<?php  echo stat('js/FormatFunction.js')['mtime'];?>"></script>
        <script src="js/component.js?timestamp=<?php  echo stat('js/component.js')['mtime'];?>"></script>
        <script src="js/formTestComponent.js?timestamp=<?php  echo stat('js/formTestComponent.js')['mtime'];?>"></script>
        <script src="js/modal_drag_drop_image.js?timestamp=<?php  echo stat('js/modal_drag_drop_image.js')['mtime'];?>"></script>
        <script src="js/modal_drag_drop_question.js?timestamp=<?php  echo stat('js/modal_drag_drop_question.js')['mtime'];?>"></script>
        <script src="js/modal_feedback_correct_or_incorrect.js?timestamp=<?php  echo stat('js/modal_feedback_correct_or_incorrect.js')['mtime'];?>"></script>
        <script src="js/data_module.js?timestamp=<?php  echo stat('js/data_module.js')['mtime'];?>"></script>
        <script src="js/XML_db_load.js?timestamp=<?php  echo stat('js/XML_db_load.js')['mtime'];?>"></script>
        <script src="js/XML_db_create.js?timestamp=<?php  echo stat('js/XML_db_create.js')['mtime'];?>"></script>
        <script src="js/XML_create_edit.js?timestamp=<?php  echo stat('js/XML_create_edit.js')['mtime'];?>"></script>
        <script src="js/XML_list_create.js?timestamp=<?php  echo stat('js/XML_list_create.js')['mtime'];?>"></script>
        <script src="js/XML.js?timestamp=<?php  echo stat('js/XML.js')['mtime'];?>"></script>
        <script src="js/XML_db_record.js?timestamp=<?php  echo stat('js/XML_db_record.js')['mtime'];?>"></script>

        <!-- <script src="js/formTestComponent.js?time=<?php echo time(); ?>"></script>
        <script src="js/modal_drag_drop_image.js?time=<?php echo time(); ?>"></script>
        <script src="js/modal_drag_drop_question.js?time=<?php echo time(); ?>"></script>
        <script src="js/modal_feedback_correct_or_incorrect.js?time=<?php echo time(); ?>"></script>
        <script src="js/data_module.js?time=<?php echo time(); ?>"></script>
        <script src="js/XML_db_load.js?time=<?php echo time(); ?>"></script>
        <script src="js/XML_db_create.js?time=<?php echo time(); ?>"></script>
        <script src="js/XML_create_edit.js?time=<?php echo time(); ?>"></script>
        <script src="js/XML_list_create.js?time=<?php echo time(); ?>"></script>
        <script src="js/XML.js?time=<?php echo time(); ?>"></script>
        <script src="js/XML_db_record.js?time=<?php echo time(); ?>"></script> -->

        <script>
            <?php
                    include_once "module_define.php";
                    include_once "module_style.php";
            ?>
            var systemconfig = {
                separateSign: ",",
                commaSign: "."
            };
        </script>
        <?php
            write_login_header();
            DOMClass::write_script();
            DOMElementClass::write_script();
            EncodingClass::write_script();
            FormClass::write_script();
            ModalElementClass::write_script();
            BootstrapElementClass::write_script();
            write_common_script();
            write_form_script();
            write_bsc2kpi1112_script();
            write_module_define_script();
            write_module_style_script();
        ?>
        <title>FORM TEST CREATE<?php if (isset($company_name)) {if ($company_name != "") echo " - ".$company_name;}?></title>
        <script type="text/javascript">
        "use strict";
            
            var database = {};
            var formTest = {
                menu: {},
                account: {},
                reporter_surveys: {},
                reporter_surveys_information: {},
                reporter_survey_perform:{},
                reporter_survey_perform_information:{},
                reporter_type_surveys: {},
                reporter_type_surveys_information: {},
                reporter_record: {},
                reporter_record_information: {},
                reporter_feedback: {},
                reporter_feedback_information: {},
                reporter_examinations: {},
                reporter_examinations_information: {},
                reporter_examinations_perform: {},
                reporter_examinations_perform_information: {},
                reporter_users:{},
                reporter_users_information:{},
                reporter_feedback_examinations:{},
                reporter_feedback_examinations_information:{},
                reporter_user_examinations:{},
                reporter_user_examinations_information:{}
            };
            var blackTheme = {
                reporter_surveys: {},
                reporter_type_surveys:{},
                reporter_questions:{},
                reporter_record: {},
                reporter_feedback: {},
                reporter_users:{},
                reporter_examinations:{}
            };
        </script>
        <style media="screen">
            .bodyFrm .resetClass{
                font-family:Arial;
            }
        </style>
        <?php
        $thememode = 1;
        write_button_071218_style_black();
        write_content_script();
        write_kpi_script();
        write_menu_script();
        LanguageModule_writeJavascript("FORM", $LanguageModule_v_defaultcode);
        write_reporter_script_black();
        write_reporter_surveys_script();
        write_reporter_surveys_information_script();
        write_reporter_survey_perform_script();
        write_reporter_survey_perform_information_script();
        write_reporter_type_surveys_script();
        write_reporter_type_surveys_information_script();
        write_reporter_record_script();
        write_reporter_record_information_script();
        write_reporter_feedback_script();
        write_reporter_feedback_information_script();
        write_reporter_examinations_script();
        write_reporter_examinations_information_script();
        write_reporter_examinations_perform_script();
        write_reporter_examinations_perform_information_script();
        write_reporter_users_script();
        write_reporter_users_information_script();
        write_reporter_feedback_examinations_script();
        write_reporter_feedback_examinations_information_script();
        write_reporter_user_examinations_script();
        write_reporter_user_examinations_information_script();
        ?>
        <link rel="icon" href="favicon.ico">
        <link rel="stylesheet" href="css/new_layout.css">
        <link rel="stylesheet" href="css/config_format.css">
        <link rel="stylesheet" href="css/new_version_1.css">
        <link rel="stylesheet" href="css/FormatFunction.css">
        <link rel="stylesheet" href="css/countdown.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <!-- <link rel="stylesheet" href=" /css/font-awesome/font-awesome.css"> -->
        <link rel="stylesheet" href="css/form.css">
        <link rel="stylesheet" href="css/form_create_edit.css">
        <link rel="stylesheet" href="css/list.css">
        <link rel="stylesheet" href="css/test_parse.css">
        <link rel="stylesheet" href="css/test.css">
        <link rel="stylesheet" href="css/test_question.css">
        <link rel="stylesheet" href="css/test_feedback.css">
        <link rel="stylesheet" href="css/important.css">
        <script type="text/javascript">
            window.mobilecheck = function() {
                let check = false;
                (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
                return check;
            };
            var init = function () {
                var userid = parseInt("<?php if (isset($_SESSION[$prefix.'userid'])) echo $_SESSION[$prefix.'userid']; else echo 0; ?>", 10);
                window.userHomeid = parseInt("<?php if (isset($_SESSION[$prefixhome."userid"])) echo $_SESSION[$prefixhome."userid"]; else echo 0; ?>", 10);
                window.privilege = parseInt("<?php if (isset($_SESSION[$prefix.'privilege'])) echo   $_SESSION[$prefix.'privilege']; else echo 0; ?>", 10);
                if (userid == 0){
                    ModalElement.alert({
                        message: "Tài khoản không có quyền truy cập ứng dụng này",
                        func: function(){
                            var link = "<?php echo $protocal.$x ?>";
                            location.href = link;
                        },
                        class: "btn btn-primary"
                    });
                    return;
                }
                window.userid = userid;
                ModalElement.alert = function (params) {
                    var message = params.message, func = params.func, h;
                    if (message === undefined) message = "";
                    if (func === undefined) func = function () {};
                    h = DOMElement.table({data: [
                        [{attrs: {style: {fontSize: "4px",height: "10px"}}}],
                        [{
                            attrs: {
                                align: "center",
                                style: {
                                    border: "0",
                                    minWidth: "200px"
                                }
                            },
                            text: message
                        }],
                        [{
                            attrs: {
                                style: {
                                    border: "0",
                                    fontSize: "4px",
                                    height: "20px"
                                }
                            }
                        }],
                        [{
                            attrs: {
                                align: "center",
                                style: {
                                    border: "0"
                                }
                            },
                            children: [
                                absol.buildDom({
                                tag: "i2flexiconbutton",
                                on: {
                                    click: function() {
                                        return function (event, me) {
                                        ModalElement.close();
                                        func();
                                        }
                                    }
                                },
                                child: [{
                                        tag: 'i',
                                        class: 'material-icons',
                                        props: {
                                            innerHTML: 'done'
                                        }
                                    },
                                    '<span>' + 'OK' + '</span>'
                                ]})]
                        }]
                    ]});
                    ModalElement.show({
                        bodycontent: h,
                        overflow: params.overflow
                    });
                };
                var holder = absol.buildDom({
                    tag:"div",
                    class:"mainstream"
                })
                DOMElement.bodyElement.appendChild(holder);
   
                    ModalElement.question = function (params) {
                    var message = params.message,title = params.title, h, func = params.onclick;
                    if (message === undefined) message = "";
                    if (title === undefined) title = "Question";
                    if (func === undefined) func = function(){};
                    var data = [
                        [{attrs: {style: {fontSize: "4px",height: "10px"}}}],
                        [{
                            attrs: {
                                align: "center",
                                style: {
                                    border: "0",
                                    minWidth: "300px",
                                }
                            },
                            text: message
                        }]
                    ];
                    data.push([{
                        attrs: {
                            style: {
                                border: "0",
                                fontSize: "4px",
                                height: "20px"
                            }
                        }
                    }],
                    [{
                        attrs: {
                            align: "center",
                            style: {
                                border: "0"
                            }
                        },
                        children: [DOMElement.table({
                            attrs: {
                                style: {
                                    border: "0"
                                }
                            },
                            data: [[
                                {
                                    attrs: {
                                        align: "center",
                                        style: {
                                            border: "0"
                                        }
                                    },
                                    children: [
                                        absol.buildDom({
                                            tag: "i2flexiconbutton",
                                            on: {
                                                click: function(func) {
                                                    return function (event, me) {
                                                        ModalElement.close();
                                                        func(0);
                                                    }
                                                } (func)
                                            },
                                            child: [{
                                                    tag: 'i',
                                                    class: 'material-icons',
                                                    props: {
                                                        innerHTML: 'done'
                                                    }
                                                },
                                                '<span>' + 'Có' + '</span>'
                                            ]
                                        })]
                                },
                                {
                                    attrs: {style: {width: "20px"}}
                                },
                                {
                                    attrs: {
                                        align: "center",
                                        style: {
                                            border: "0"
                                        }
                                    },
                                    children: [
                                        absol.buildDom({
                                            tag: "i2flexiconbutton",
                                            on: {
                                                click: function(func) {
                                                    return function (event, me) {
                                                        ModalElement.close();
                                                        func(1);
                                                    }
                                                } (func)
                                            },
                                            child: [{
                                                    tag: 'i',
                                                    class: 'material-icons',
                                                    props: {
                                                        innerHTML: 'clear'
                                                    }
                                                },
                                                '<span>' + 'Không' + '</span>'
                                            ]
                                        })]
                                }
                            ]]
                        })]
                    }]);
                    h = DOMElement.table({data: data});
                    ModalElement.showWindow({
                        title: title,
                        bodycontent: h
                    });
                };
                    formTest.menu.init(holder);
                    formTest.prefix = "<?php if (isset($prefix)) {echo $prefix;}?>";
                    formTest.prefixhome = "<?php if (isset($prefixhome)) {echo $prefixhome;}?>";
                    formTest.dbname = "<?php if (isset($dbname)) {echo $dbname;}?>";
                    formTest.dbnamelibary = "<?php if (isset($dbnamelibary)) {echo $dbnamelibary;}?>";
            };
        </script>
    </head>
	<body onload="setTimeout('init();',  10);"></body>
</html>
