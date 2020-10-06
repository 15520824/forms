<?php
    function write_reporter_examinations_perform_information_script() {
        global $prefix;
?>
<script type="text/javascript">
// formTest.generalInformation.index = 0;
//
//    state 
//    0:state information 
//    1:state Mission

formTest.reporter_examinations_perform_information.tableCreate = function(host) {
    var x = DOMElement.table({
        attrs: {
            style: {
                width: "100%"
            },
            className:"nth examinationsTable"
        },
        header: [{
                attrs: {
                    style: {
                        width: "80px"
                    }
                },
                text: "STT"
            },
            {
                attrs: {},
                text: 'Tên'
            },
            {
                attrs: {
                    style: {
                        width: "200px"
                    }
                },
                text: 'Bắt đầu'
            },
            {
                attrs: {
                    style: {
                        width: "200px"
                    }
                },
                text: 'Kết thúc'
            },
            {
                attrs: {
                    style: {
                        width: "200px"
                    }
                },
                text: 'Trạng thái'
            },
            {
                attrs: {
                    style: {
                        width: "40px"
                    }
                }
            }
        ],
        data: blackTheme.reporter_examinations.generateTableDataExaminations(host,false),
        searchbox: true
    });
    host.tableCenter = x;
    if(formTest.reporter_examinations_perform_information.hosts===undefined)
    formTest.reporter_examinations_perform_information.hosts=[];
    formTest.reporter_examinations_perform_information.hosts.push(host);
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
formTest.reporter_examinations_perform_information.redrawTable = function() {
    var x;
    var promiseAll=[];
    var userLink, surveyLink, checkLink = [];
    var newPromise = new Promise(function(resolve,reject){
        var promiseLink = data_module.link_examination_user.loadByUser(window.userid).then(function(result){
            userLink = result;
            if(userLink)
            {
                var checkLink = [];
                for(var i=0;i<userLink.length;i++)
                {
                    checkLink[userLink[i].examinationid] = userLink[i];
                }
            }
            if(result.length>0)
            {
                var count = result.length;
                for(var i = 0;i<result.length;i++)
                {
                    surveyLink = [];
                    var promiseChild = data_module.link_examination_survey.loadByExamination(result[i].examinationid);
                    promiseAll.push(promiseChild);
                    promiseChild.then(function(dataLink){
                        dataLink = dataLink[0];
                        surveyLink[dataLink.examinationid] = dataLink;
                        count--;
                        if(count === 0)
                        {
                            resolve();
                        }
                    })
                }
                resolve();
            }
            else
            resolve();
        });
        promiseAll.push(promiseLink);
    });
    
    promiseAll.push(newPromise);
    Promise.all(promiseAll).then(function() {
        for(var i=0;i<formTest.reporter_examinations_perform_information.hosts.length;i++){
            formTest.reporter_examinations_perform_information.hosts[i].userLink = checkLink;
            formTest.reporter_examinations_perform_information.hosts[i].surveyLink = surveyLink;
            x = DOMElement.table({
            attrs: {
                style: {
                    width: "100%"
                },
                className:"nth examinationsTable"
            },
            header: [{
                    attrs: {
                        style: {
                            width: "80px"
                        }
                    },
                    text: "STT"
                },
                {
                    attrs: {},
                    text: 'Tên'
                },
                {
                    attrs: {
                        style: {
                            width: "200px"
                        }
                    },
                    text: 'Bắt đầu'
                },
                {
                    attrs: {
                        style: {
                            width: "200px"
                        }
                    },
                    text: 'Kết thúc'
                },
                {
                    attrs: {
                        style: {
                            width: "200px"
                        }
                    },
                    text: 'Trạng thái'
                },
                {
                    attrs: {
                        style: {
                            width: "40px"
                        }
                    }
                }
            ],
            data: blackTheme.reporter_examinations.generateTableDataExaminations(formTest.reporter_examinations_perform_information.hosts[i],false),
            searchbox: true
        });
        var parentNode = formTest.reporter_examinations_perform_information.hosts[i].tableCenter.parentNode
        DOMElement.removeAllChildren(parentNode);
        parentNode.appendChild(x)
        formTest.reporter_examinations_perform_information.hosts[i].tableCenter = x;
        //to do update size
        }
    })
}

formTest.reporter_examinations_perform_information.Container = function(host) {
    return DOMElement.div({
        attrs: {
            className: "all-build"
        },
        children: [
            formTest.reporter_examinations_perform_information.tableCreate(host)
        ]
    })
}

formTest.reporter_examinations_perform_information.loadPage = function(container, host) {

    var containerList = formTest.reporter_examinations_perform_information.Container(host);

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

formTest.reporter_examinations_perform_information.init = function(container, host) {
    this.loadPage(container, host)
}
</script>

<?php
}
?>