<?php
    function write_reporter_survey_perform_information_script() {
        global $prefix;
?>
<script type="text/javascript">
// formTest.generalInformation.index = 0;
//
//    state 
//    0:state information 
//    1:state Mission

formTest.reporter_survey_perform_information.tableCreate = function(host) {
    var x = DOMElement.table({
        attrs: {
            style: {
                width: "100%"
            },
            className:"nth"
        },
        header: [{
                attrs: {
                },
                text: "STT"
            },
            {
                attrs: {},
                text: 'Tên'
            },
            {
                attrs: {},
                text: 'Loại'
            },
            {
                attrs: {
                    style: {
                        width: "40px"
                    }
                }
            }
        ],
        data: blackTheme.reporter_surveys.generateTableDatasurvey(host,undefined,false),
        searchbox: true
    });
    host.tableCenter = x;
    if(formTest.reporter_survey_perform_information.hosts===undefined)
    formTest.reporter_survey_perform_information.hosts=[];
    formTest.reporter_survey_perform_information.hosts.push(host);
    return DOMElement.div({
        attrs: {
            className: "KPIsimpletableclass row2colors KPItablehover",
            style: {
                width: "100%"
            }
        },
        children: [x]
    })
}
formTest.reporter_survey_perform_information.redrawTable = function(index = -1,host) {
    var x;
    if(window.privilege==0)
    {
        var tempPromise = data_module.link_survey_user.load();
        tempPromise.then(function(result){
            for(var i=0;i<formTest.reporter_survey_perform_information.hosts.length;i++){
                formTest.reporter_survey_perform_information.hosts[i].linkUser = result;
                if(host!==undefined&& host !== formTest.reporter_survey_perform_information.hosts[i])
                continue;
                x = DOMElement.table({
                attrs: {
                    style: {
                        width: "100%"
                    },
                    className:"nth"
                },
                header: [{
                        attrs: {
                        },
                        text: "STT"
                    },
                    {
                        attrs: {},
                        text: 'Tên'
                    },
                    {
                        attrs: {},
                        text: 'Loại'
                    },
                    {
                        attrs: {
                            style: {
                                width: "40px"
                            }
                        }
                    }
                ],
                data: blackTheme.reporter_surveys.generateTableDatasurvey(formTest.reporter_survey_perform_information.hosts[i],index,false),
                searchbox: true
                });
                var parentNode = formTest.reporter_survey_perform_information.hosts[i].tableCenter.parentNode
                DOMElement.removeAllChildren(parentNode);
                parentNode.appendChild(x)
                formTest.reporter_survey_perform_information.hosts[i].tableCenter = x;
            }
        })
    }
    
}

formTest.reporter_survey_perform_information.Container = function(host) {
    return DOMElement.div({
        attrs: {
            className: "all-build"
        },
        children: [
            formTest.reporter_survey_perform_information.tableCreate(host)
        ]
    })
}

formTest.reporter_survey_perform_information.loadPage = function(container, host) {

    var containerList = formTest.reporter_survey_perform_information.Container(host);

    host.containerList = containerList;

    var containerRelative = absol.buildDom({
        tag:"div",
        class:"common-container",
        child:[
            containerList
        ]
    });

    container.appendChild(
        DOMElement.div({
            attrs: {
                className: "common",
            },
            children: [
                containerRelative
            ]
        })
    )
}

formTest.reporter_survey_perform_information.init = function(container, host) {
    this.loadPage(container, host)
}
</script>

<?php
}
?>