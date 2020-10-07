<?php
    function write_reporter_surveys_script(){
?>
<script type="text/javascript">
"use strict";

formTest.reporter_surveys.generateData = function(host) {
    var data, header;
    DOMElement.removeAllChildren(host.survey_container_container);
};

formTest.reporter_surveys.init = function(host, mode) {
    host.database = {};
    host.root_survey = 0;
    host.frameList = absol.buildDom({
        tag: 'frameview',
        style: {
            width: '100%',
            height: '100%'
        }
    });
    var promiseAll = [];
    promiseAll.push(data_module.type.load());
    promiseAll.push(data_module.survey.load());
    if(window.privilege==0)
    {
        var tempPromise = data_module.link_survey_user.load();
        tempPromise.then(function(result){
            host.linkUser = result;
        })
        promiseAll.push(tempPromise);
    }
    Promise.all(promiseAll).then(function() {
        var childArrButton = [{
                            tag: "i2flexiconbutton",
                            on: {
                                click: function(host) {
                                    return function() {
                                        formTest.menu.tabPanel.removeTab(host.holder
                                            .id);
                                    }
                                }(host)
                            },
                            child: [{
                                    tag: 'i',
                                    class: 'material-icons',
                                    props: {
                                        innerHTML: 'clear'
                                    }
                                },
                                '<span>' + 'Đóng' + '</span>'
                            ]
                        }
                    ]

        if(window.privilege)
        {
            childArrButton.push({
                tag: "i2flexiconbutton",
                on: {
                    click: function(host) {
                        return function() {
                            ModalElement.show_loading();
                            data_module.usersList.load().then(function(){
                                var temp1 = blackTheme.reporter_surveys.addSurvey(host);
                                host.frameList.addChild(temp1);
                                host.frameList.activeFrame(temp1);
                                ModalElement.close(-1);
                            })
                            DOMElement.cancelEvent(event);
                        }
                    }(host)
                },
                child: [{
                        tag: 'i',
                        class: 'material-icons',
                        props: {
                            innerHTML: 'add'
                        }
                    },
                    '<span>' + 'Thêm' + '</span>'
                ]
            });
        }
        childArrButton.push(absol.buildDom({
                            tag:"selectmenu",
                            style:{
                                verticalAlign: "middle",
                                width:"calc(40% - 220px)"
                            },
                            props:{
                                items:[
                                    {text:"Tất cả", value:-1},
                                    {text:"Bài tập", value:1},
                                    {text:"Bài kiểm tra", value:0}
                                ],
                                value:-1
                            },
                            on:{
                                change:function(event){
                                    formTest.reporter_surveys_information.redrawTable(this.value,host)
                                }
                            }
                        }))
        var mainFrame = absol.buildDom({
            tag: 'singlepage',
            child: [{
                    class: 'absol-single-page-header',
                    child: childArrButton
                },
                {
                    class: 'absol-single-page-footer'
                }
            ]
        });
        formTest.menu.footer(absol.$('.absol-single-page-footer', mainFrame));
        host.frameList.addChild(mainFrame);
        host.frameList.activeFrame(mainFrame);
        host.holder.addChild(host.frameList);
        switch (mode) {
            case 1:
                formTest.reporter_surveys_information.init(mainFrame.$viewport, host)
                break;
            case 2:
                break;
            case 3:
                break;
        }

        host.holder.addChild(host.frameList);

        host.contextCaptor = absol._('contextcaptor').addTo(mainFrame);

        host.contextCaptor.attachTo(mainFrame);
    })
}
</script>

<?php } ?>