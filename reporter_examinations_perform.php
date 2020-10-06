<?php
    function write_reporter_examinations_perform_script(){
?>
<script type="text/javascript">
"use strict";

formTest.reporter_examinations_perform.generateData = function(host) {
    var data, header;
    DOMElement.removeAllChildren(host.type_survey_container_container);
};

formTest.reporter_examinations_perform.init = function(host, mode) {
    host.database = {};
    host.root_type_survey = 0;
    host.frameList = absol.buildDom({
        tag: 'frameview',
        style: {
            width: '100%',
            height: '100%'
        }
    });
    var promiseAll=[];
    ModalElement.show_loading();
    var newPromise = new Promise(function(resolve,reject){
        var promiseLink = data_module.link_examination_user.loadByUser(window.userid).then(function(result){
            var userLink = result;
            if(userLink)
            {
                var checkLink = [];
                for(var i=0;i<userLink.length;i++)
                {
                    checkLink[userLink[i].examinationid] = userLink[i];
                }
            }
            host.userLink = checkLink;
            if(result.length>0)
            {
                var count = result.length;
                for(var i = 0;i<result.length;i++)
                {
                    host.surveyLink = [];
                    var promiseChild = data_module.link_examination_survey.loadByExamination(result[i].examinationid);
                    promiseChild.then(function(dataLink){
                        dataLink = dataLink[0];
                        host.surveyLink[dataLink.examinationid] = dataLink;
                        count--;
                        if(count === 0)
                        {
                            resolve();
                        }
                    })
                    promiseAll.push(promiseChild);
                }
            }
            else
            {
                resolve();
            }
        });
        promiseAll.push(promiseLink);
    });
    
    promiseAll.push(data_module.examinations.load());
   
    promiseAll.push(newPromise);
    Promise.all(promiseAll).then(function() {
        var mainFrame = absol.buildDom({
            tag: 'singlepage',
            child: [{
                    class: 'absol-single-page-header',
                    child: [
                        {
                                tag: "i2flexiconbutton",
                                on: {
                                    click: function(host) {
                                        return function() {
                                            formTest.menu.tabPanel.removeTab(host.holder.id);
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
                        },
                        {
                                tag: "i2flexiconbutton",
                                on: {
                                    click: function(host) {
                                        return function(){
                                        var temp1 = blackTheme.reporter_examinations_perform_perform.addExamination(host);
                                        host.frameList.addChild(temp1);
                                        host.frameList.activeFrame(temp1);
                                        DOMElement.cancelEvent(event);
                                        return false;
                                            
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
                        }
                    ]
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
                formTest.reporter_examinations_perform_information.init(mainFrame.$viewport, host)
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