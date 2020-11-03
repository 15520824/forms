<?php
    function write_reporter_user_examinations_information_script() {
        global $prefix;
?>
<script type="text/javascript">
// formTest.generalInformation.index = 0;
//
//    state 
//    0:state information 
//    1:state Mission

formTest.reporter_user_examinations_information.Container = function(host) {
    var temp = absol.buildDom({
        tag: "div",
        class: "all-build",
        child: [

        ]
    })
    formTest.reporter_user_examinations_information.headMask(host, temp);
    return temp;
}

formTest.reporter_user_examinations_information.headMask = function(host, childContainer) {
    var rowContainer = absol.buildDom({
                    tag: "div",
                    class: "freebirdFormeditorViewHeaderTopRow",
                });
    var temp = absol.buildDom({
                tag: "div",
                class: [
                    "freebirdFormeditorViewHeaderHeaderMast",
                    "freebirdHeaderMastWithOverlay"
                ],
                child: [rowContainer]
            })
    childContainer.appendChild(temp);
    var promiseAll=[];
    promiseAll.push(data_module.usersList.load());
    promiseAll.push(data_module.usersListHome.load());
    var arr = [];
    var count = 0;
    var checkExamination = [];
    var newPromise = new Promise(function(resolve,reject){
        for(var i = 0;i<host.record_test.length;i++)
        {
            if(checkExamination[host.record_test[i].examinationid]===undefined)
            {
                checkExamination[host.record_test[i].examinationid] = 1;
                data_module.link_examination_survey.loadByExamination(host.record_test[i].examinationid).then(function(result){
                    arr = arr.concat(result);
                    count++;
                    if(count == host.record_test.length)
                    {
                        resolve();
                    }
                })
            }else
            {
                count++;
                if(count == host.record_test.length)
                {
                    resolve();
                }
            }
        }
    })

    promiseAll.push(newPromise);
    Promise.all(promiseAll).then(function(){
        var survey,userList;
        host.linkSurvey = arr;
        var result = data_module.examinations.getTypeFromItems(host.linkSurvey,host.record_test);
             var time = absol.buildDom({
                tag: "input",
            });    
                 
            var examination = absol.buildDom({
                tag: "selectmenu",
                props: {
                    enableSearch: true,
                    items: data_module.type.items.map(function(u, i) {
                        return {
                            text: u.value,
                            value: u.id
                        };
                    })
                },
                on: {
                    change: function(event, me) {
                        if(this.value == -1)
                        {
                            for (var i = childContainer.childNodes.length - 1; i > 0; i--) {
                                childContainer.removeChild(childContainer.childNodes[i]);
                            }
                            return;
                        }
                        var objectUpdate = this.objectUpdate[this.value];
                        if(objectUpdate.time.getTime() == 0)
                        {
                            time.value = "Chưa thực hiện bài kiểm tra này";
                            for (var i = childContainer.childNodes.length - 1; i > 0; i--) {
                                childContainer.removeChild(childContainer.childNodes[i]);
                            }
                            return;
                        }
                        var cloneXmlRequest = {...xmlRequest};
                        host.page = cloneXmlRequest;
                        cloneXmlRequest.editMode = true;
                        ModalElement.show_loading();
                        childContainer.classList.add("disabled");
                        var timeStamp = objectUpdate.time;
                        cloneXmlRequest.readXMLFromDB(objectUpdate.survey.id, childContainer).then(
                            function(e) {
                                time.value = formatDate(timeStamp,true,true);
                                console.log(objectUpdate.id)
                                data_module.record.loadByRecordTest([{name:"record_testid",value:objectUpdate.id}]).then(function(valid){
                                    ModalElement.close(-1);
                                    childContainer.childNodes[1].setAnswer(valid);
                                    host.prevButton.updateVisiable();
                                    host.nextButton.updateVisiable();
                                })
                            })
                    }
                }
            });

            examination.setObject = function(items,objectUpdate)
            {
                examination.items = items;
                examination.value = items[0].value;
                examination.objectUpdate = objectUpdate;
                examination.emit("change")
            }

            
            
            var finalValue=[];
           
            if(result.length === 0)
                finalValue = [{text:"Chưa có người tham gia khảo sát", value: -1}]
                else
                for(var paramid in result)
                {
                    finalValue.push({
                        text: data_module.usersListHome.getID(result[paramid].homeid).fullname,
                        value: paramid
                    })
                }

            userList = absol.buildDom({
                    tag: "selectmenu",
                    props: {
                        enableSearch: true,
                        items: finalValue,
                    },
                    on: {
                        change: function(event, me) {
                            var objectUpdate  = [];
                            var finalValueX=[];
                            if(result[me.value].examination.length === 0)
                            finalValueX = [{text:"Không có bài kiểm tra nào", value: -1}]
                            else{
                                for(var paramid in result[me.value].examination)
                                {
                                    finalValueX.push({
                                        text: result[me.value].examination[paramid].examination.name,
                                        value: paramid,
                                    })
                                    objectUpdate[paramid]=result[me.value].examination[paramid];
                                }
                            }
                            examination.setObject(finalValueX,objectUpdate);
                        }
                    }
            });

            if(window.privilege == 0)
            {
                userList.style.pointerEvents = "none";
            }
        
            rowContainer.addChild(absol.buildDom({
                            tag: "div",
                            class: "freebirdFormeditorViewTabTitleLabel",
                            props: {
                                innerHTML: "Người tham gia "
                            }
                        }));
            rowContainer.addChild(userList);

            rowContainer.addChild(absol.buildDom({
                            tag: "div",
                            class: "freebirdFormeditorViewTabTitleLabel",
                            props: {
                                innerHTML: "Bài kiểm tra "
                            }
                        }));
            rowContainer.addChild(examination);

            rowContainer.addChild(absol.buildDom({
                            tag: "div",
                            class: "freebirdFormeditorViewTabTitleLabel",
                            props: {
                                innerHTML: "Thời gian thực hiện "
                            }
                        }));
            rowContainer.addChild(time);

            userList.emit("change",undefined,userList);
    })

  
    return temp;
}

formTest.reporter_user_examinations_information.loadPage = function(container, host) {

    var containerList = formTest.reporter_user_examinations_information.Container(host);

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

formTest.reporter_user_examinations_information.init = function(container, host) {
    this.loadPage(container, host)
}
</script>

<?php
}
?>