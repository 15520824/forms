<?php
    function write_reporter_feedback_examinations_script(){
?>
<script type="text/javascript">
"use strict";

formTest.reporter_feedback_examinations.generateData = function(host) {
    var data, header;
    DOMElement.removeAllChildren(host.type_survey_container_container);
};

formTest.reporter_feedback_examinations.init = function(host, mode) {
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
    promiseAll.push(data_module.examinations.load());
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
                                            
                                        }
                                    }(host)
                                },
                                child: [{
                                        tag: 'i',
                                        class: 'material-icons',
                                        props: {
                                            innerHTML: 'save_alt'
                                        }
                                    },
                                    '<span>' + 'Export' + '</span>'
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
                formTest.reporter_feedback_examinations_information.init(mainFrame.$viewport, host)
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