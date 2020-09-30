<?php
    function write_reporter_script_black() {
        global $prefix;

?>
<script type="text/javascript">
blackTheme.reporter_surveys.generateTableDatasurvey = function(host) {
    var data = [];
    var celldata = [];
    var indexlist = [];
    var temp;
    var i, k, sym, con;

    for (i = 0; i < data_module.survey.items.length; i++) {
        indexlist.push(i);
    }
    for (k = 0; k < data_module.survey.items.length; k++) {
        i = indexlist[k];
        celldata = [k + 1];
        celldata.push({
            text: data_module.survey.items[i].value
        });
        celldata.push({
            text: data_module.type.getById(data_module.survey.items[i].type).value
        });
        list = [];

        if (true) {
            sym = DOMElement.i({
                attrs: {
                    className: "material-icons",
                    style: {
                        fontSize: "20px",
                        color: "#929292"
                    }
                },

                text: "mode_edit"
            });
            con = DOMElement.div({
                attrs: {
                    style: {
                        width: "100px"
                    }
                },
                text: 'Sửa'
            });
            sym.onmouseover = con.onmouseover = function(sym, con) {
                return function(event, me) {
                    sym.style.color = "black";
                    con.style.color = "black";
                }
            }(sym, con);
            sym.onmouseout = con.onmouseout = function(sym, con) {
                return function(event, me) {
                    sym.style.color = "#929292";
                    con.style.color = "#929292";
                }
            }(sym, con);
            list.push({
                attrs: {
                    style: {
                        width: "170px"
                    }
                },
                symbol: sym,
                content: con,
                onclick: function(tempabc, index, host) {
                    return function(){
                    ModalElement.show_loading();
                    data_module.usersList.load().then(function(){
                        var temp1 = blackTheme.reporter_surveys.addSurvey(host,tempabc.id);
                        host.frameList.addChild(temp1);
                        host.frameList.activeFrame(temp1);
                        ModalElement.close(-1);
                    })
                    DOMElement.cancelEvent(event);
                    return false;
                    }
                }(data_module.survey.items[i], i, host)
            });
        }
        sym = DOMElement.i({
                attrs: {
                    className: "material-icons",
                    style: {
                        fontSize: "20px",
                        color: "#929292"
                    }
                },

                text: "playlist_add_check"
            });
            con = DOMElement.div({
                attrs: {
                    style: {
                        width: "100px"
                    }
                },
                text: 'Thực hiện'
            });
            sym.onmouseover = con.onmouseover = function(sym, con) {
                return function(event, me) {
                    sym.style.color = "black";
                    con.style.color = "black";
                }
            }(sym, con);
            sym.onmouseout = con.onmouseout = function(sym, con) {
                return function(event, me) {
                    sym.style.color = "#929292";
                    con.style.color = "#929292";
                }
            }(sym, con);
            list.push({
                attrs: {
                    style: {
                        width: "170px"
                    }
                },
                symbol: sym,
                content: con,
                onclick: function(tempabc, index, host) {
                    return function(){
                    var temp1 = blackTheme.reporter_surveys.performSurvey(host,tempabc.id);
                    host.frameList.addChild(temp1);
                    host.frameList.activeFrame(temp1);
                    DOMElement.cancelEvent(event);
                    return false;
                    }
                }(data_module.survey.items[i], i, host)
        });
        sym = DOMElement.i({
                attrs: {
                    className: "material-icons",
                    style: {
                        fontSize: "20px",
                        color: "#929292"
                    }
                },
                text: "delete_sweep"
            }),
            con = DOMElement.div({
                attrs: {
                    style: {
                        width: "100px"
                    }
                },
                text: 'Xóa'
            });
        sym.onmouseover = con.onmouseover = function(sym, con) {
            return function(event, me) {
                sym.style.color = "black";
                con.style.color = "black";
            }
        }(sym, con);
        sym.onmouseout = con.onmouseout = function(sym, con) {
            return function(event, me) {
                sym.style.color = "#929292";
                con.style.color = "#929292";
            }
        }(sym, con);
        list.push({
            attrs: {
                style: {
                    width: "170px"
                }
            },
            symbol: sym,
            content: con,
            onclick: function(id, host) {
                return function(event, me) {
                    blackTheme.reporter_surveys.removesurvey(id);
                    DOMElement.cancelEvent(event);
                    return false;
                }
            }(data_module.survey.items[i].id, host)
        });
        h = DOMElement.choicelist({
            textcolor: "#929292",
            align: "right",
            symbolattrs: {
                style: {
                    width: "40px"
                }
            },
            list: list
        });
        celldata.push({
            attrs: {
                style: {
                    width: "40px",
                    textAlign: "center"
                }
            },
            children: [
                DOMElement.i({
                    attrs: {
                        className: "material-icons " + DOMElement.dropdownclass.button,
                        style: {
                            fontSize: "20px",
                            cursor: "pointer",
                            color: "#929292"
                        },
                        onmouseover: function(event, me) {
                            me.style.color = "black";
                        },
                        onmouseout: function(event, me) {
                            me.style.color = "#929292";
                        },
                        onclick: function(host1) {
                            return function(event, me) {
                                host1.toggle();
                                DOMElement.cancelEvent(event);
                                return false;
                            }
                        }(h)
                    },
                    text: "more_vert"
                }), h
            ]
        });
        data.push(celldata);
    }
    return data;
};

blackTheme.reporter_surveys.removesurvey = function(id) {
    ModalElement.question({
        title: 'Xóa bài khảo sát',
        message: 'Bạn có chắc muốn xóa : ' + "" + data_module.survey.getByID(id).value,
        choicelist: [
                {
                    text: "Đồng ý"
                },
                {
                    text: "Hủy"
                }
        ],
        onclick: function(id) {
            return function(selectedindex) {
                switch (selectedindex) {
                    case 0:
                        data_module.survey.removeOne(id);
                        break;
                    case 1:
                        // do nothing
                        break;
                }
            }
        }(id)
    });
}

blackTheme.reporter_surveys.addSurvey = function(host,id){
    var containerList = absol.buildDom({
        tag:"div",
        class:"update-catergory"
    })
    var temp = absol.buildDom({
        tag:'singlepage',
        child:[
            {
                class: 'absol-single-page-header',
                child:[
                    {
                        tag: "i2flexiconbutton",
                        on: {
                            click: function(evt) {
                                temp.selfRemove();
                                var arr=host.frameList.getAllChild();
                                host.frameList.activeFrame(arr[arr.length-1]);
                            }
                        },
                        props: {
                            icon: {
                                tag: 'i',
                                class: 'material-icons',
                                props: {
                                    innerHTML: 'close'
                                },
                            },
                            text:  "Đóng"
                        }
                    },
                    {
                        tag: "i2flexiconbutton",
                        class:"info",
                        on: {
                            click: function(evt) {
                                if(containerList.childNodes[0]!==undefined)
                                {
                                    ModalElement.show_loading();
                                    xmlDbCreate.saveAll(containerList.childNodes[0].getValue()).then(function(){
                                        ModalElement.close(-1);
                                        var arrSrc = document.getElementsByTagName("img");
                                        for(var i=0;i<arrSrc.length;i++)
                                        {
                                            if(arrSrc[i].getAttribute("src")!==null)
                                            if(arrSrc[i].getAttribute("src").indexOf("./img/delete/img")!==-1)
                                            arrSrc[i].src=arrSrc[i].getAttribute("src").replace("./img/delete/img", "./img/upload/img");
                                        }
                                        xmlModalDragImage.deleteAllTrash();
                                    })
                                }
                            }
                        },
                        child: [{
                                tag: 'i',
                                class: 'material-icons',
                                props: {
                                    innerHTML: 'save'
                                },
                            },
                            '<span>' + "Lưu" + '</span>'
                        ]
                    },
                    {
                        tag: "i2flexiconbutton",
                        on: {
                            click: function(evt) {
                                if(containerList.childNodes[0]!==undefined)
                                {
                                    ModalElement.show_loading();
                                    xmlDbCreate.saveAll(containerList.childNodes[0].getValue()).then(function(){
                                        ModalElement.close(-1);
                                        var arrSrc = document.getElementsByTagName("img");
                                        for(var i=0;i<arrSrc.length;i++)
                                        {
                                            if(arrSrc[i].getAttribute("src")!==null)
                                            if(arrSrc[i].getAttribute("src").indexOf("./img/delete/img")!==-1)
                                            arrSrc[i].src=arrSrc[i].getAttribute("src").replace("./img/delete/img", "./img/upload/img");
                                        }
                                        xmlModalDragImage.deleteAllTrash();
                                        temp.selfRemove();
                                        var arr=host.frameList.getAllChild();
                                        host.frameList.activeFrame(arr[arr.length-1]);
                                    })
                                }
                            }
                        },
                        child: [{
                                tag: 'i',
                                class: 'material-icons',
                                props: {
                                    innerHTML: 'save'
                                },
                            },
                            '<span>' + "Lưu và đóng" +
                            '</span>'
                        ]
                    },
                    {
                        tag: "i2flexiconbutton",
                        on: {
                            click: function(evt) {
                                if(containerList.childNodes[0]!==undefined)
                                {
                                    var popUp = window.open("https://keeview.com/tpn1/form/XMLparseFormPreview.php",'');
                                    popUp.xmlData=containerList.childNodes[0].getValue();
                                } 
                            }
                        },
                        child: [{
                                tag: 'i',
                                class: 'material-icons',
                                props: {
                                    innerHTML: 'remove_red_eye'
                                },
                            },
                            '<span>' + "Xem trước" + '</span>'
                        ]
                    }
                ]
            },
            {
                class: 'absol-single-page-footer'
            }
        ]})
    var cloneXmlRequestCreateEdit = {...xmlRequestCreateEdit};
    ModalElement.show_loading();
    var opposite = cloneXmlRequestCreateEdit.readXMLFromDB(id,containerList,host).then(function(e){
        ModalElement.close(-1);
    })
    temp.addChild(containerList);
    formTest.menu.footer(absol.$('.absol-single-page-footer', temp));
    return temp;
}

blackTheme.reporter_surveys.performSurvey = function(host,id){
    var containerList = absol.buildDom({
        tag:"div",
        class:"update-catergory"
    })
    var temp = absol.buildDom({
        tag:'singlepage',
        child:[
            {
                class: 'absol-single-page-header',
                child:[
                    {
                        tag: "i2flexiconbutton",
                        on: {
                            click: function(evt) {
                                temp.close();
                            }
                        },
                        child: [{
                                tag: 'i',
                                class: 'material-icons',
                                props: {
                                    innerHTML: 'close'
                                },
                            },
                            '<span>' + "Đóng" + '</span>'
                        ]
                    }
                ]
            },
            {
                class: 'absol-single-page-footer'
            }
        ]})
    var cloneXmlRequest = {...xmlRequest};
    ModalElement.show_loading();
    cloneXmlRequest.readXMLFromDB(id,containerList).then(function(e){
        ModalElement.close(-1);
    })
    temp.close = function()
    {
        temp.selfRemove();
        var arr=host.frameList.getAllChild();
        host.frameList.activeFrame(arr[arr.length-1]);
    }
    temp.addChild(containerList);
    formTest.menu.footer(absol.$('.absol-single-page-footer', temp));
    return temp;
}

blackTheme.reporter_surveys.updateSurvey = function(host, param) {
    var temp = absol.buildDom({
        tag:'singlepage',
        child:[
            {
                class: 'absol-single-page-header',
                child:[
                    {
                        tag: "i2flexiconbutton",
                        on: {
                            click: function(evt) {
                                temp.selfRemove();
                                var arr=host.frameList.getAllChild();
                                host.frameList.activeFrame(arr[arr.length-1]);
                            }
                        },
                        child: [{
                                tag: 'i',
                                class: 'material-icons',
                                props: {
                                    innerHTML: 'save'
                                },
                            },
                            '<span>' + "Đóng" + '</span>'
                        ]
                    },
                    {
                        tag: "i2flexiconbutton",
                        on: {
                            click: function(evt) {
                                var paramEdit = [{
                                        name: "id",
                                        value: param.id
                                    },
                                    {
                                        name: "value",
                                        value: name.childNodes[1].value
                                    },
                                ]
                                data_module.type.updateOne(paramEdit)
                                    .then(function() {
                                    })


                            }
                        },
                        child: [{
                                tag: 'i',
                                class: 'material-icons',
                                props: {
                                    innerHTML: 'save'
                                },
                            },
                            '<span>' + "Lưu" + '</span>'
                        ]
                    },
                    {
                        tag: "i2flexiconbutton",
                        on: {
                            click: function(evt) {
                                var paramEdit = [{
                                        name: "id",
                                        value: param.id
                                    },
                                    {
                                        name: "value",
                                        value: name.childNodes[1].value
                                    },
                                ]
                                data_module.type.updateOne(paramEdit)
                                    .then(function() {
                                        temp.selfRemove();
                                        var arr=host.frameList.getAllChild();
                                        host.frameList.activeFrame(arr[arr.length-1]);
                                    })


                            }
                        },
                        child: [{
                                tag: 'i',
                                class: 'material-icons',
                                props: {
                                    innerHTML: 'save'
                                },
                            },
                            '<span>' + "Lưu và đóng" +
                            '</span>'
                        ]
                    }
                ]
            },
            {
                class: 'absol-single-page-footer'
            }
        ]})
        formTest.menu.footer(absol.$('.absol-single-page-footer', temp));
        temp.addChild(DOMElement.div({
                attrs: {
                    className: "update-catergory",
                },
                children: [
                    name,
                ]
            }));
    return temp;
}

blackTheme.reporter_examinations.generateTableDataExaminations = function(host)
{
    var data = [];
    var celldata = [];
    var indexlist = [];
    var temp;
    var i, k, sym, con;

    for (i = 0; i < data_module.examinations.items.length; i++) {
        indexlist.push(i);
    }
    for (k = 0; k < data_module.examinations.items.length; k++) {
        i = indexlist[k];
        celldata = [k + 1];
        celldata.push({
            text: data_module.examinations.items[i].name
        });
        celldata.push({
            text: formatDate(data_module.examinations.items[i].start,true,true)
        });
        celldata.push({
            text: formatDate(data_module.examinations.items[i].end,true,true)
        });
        var now = new Date();
        var start = new Date(data_module.examinations.items[i].start);
        var end = new Date(data_module.examinations.items[i].end);
        var textStatus = "Đang diễn ra";
        if(now<start)
        {
            textStatus = "Sắp diền ra";
        }else if(now>end)
        {
            textStatus = "Đã hết hạn";
        }
        celldata.push({
            text: textStatus
        });
        list = [];

        if (true) {
            sym = DOMElement.i({
                attrs: {
                    className: "material-icons",
                    style: {
                        fontSize: "20px",
                        color: "#929292"
                    }
                },
                text: "mode_edit"
            });
            con = DOMElement.div({
                attrs: {
                    style: {
                        width: "100px"
                    }
                },
                text: 'Sửa'
            });
            sym.onmouseover = con.onmouseover = function(sym, con) {
                return function(event, me) {
                    sym.style.color = "black";
                    con.style.color = "black";
                }
            }(sym, con);
            sym.onmouseout = con.onmouseout = function(sym, con) {
                return function(event, me) {
                    sym.style.color = "#929292";
                    con.style.color = "#929292";
                }
            }(sym, con);
            list.push({
                attrs: {
                    style: {
                        width: "170px"
                    }
                },
                symbol: sym,
                content: con,
                onclick: function(tempabc, index, host) {
                    return function(){
                        ModalElement.show_loading();
                        var promiseAll = [];
                        promiseAll.push(data_module.link_examination_survey.loadByExamination(tempabc.id));
                        promiseAll.push(data_module.link_examination_user.loadByExamination(tempabc.id));
                        promiseAll.push(data_module.usersList.load());
                        Promise.all(promiseAll).then(function(result){
                            var temp1 = blackTheme.reporter_examinations.updateExamination(host,tempabc,result);
                            host.frameList.addChild(temp1);
                            host.frameList.activeFrame(temp1);
                            ModalElement.close(-1);
                        })
                        DOMElement.cancelEvent(event);
                        return false;
                    }
                }(data_module.examinations.items[i], i, host)
            });
        }
        sym = DOMElement.i({
                attrs: {
                    className: "material-icons",
                    style: {
                        fontSize: "20px",
                        color: "#929292"
                    }
                },
                text: "delete_sweep"
            }),
        con = DOMElement.div({
                attrs: {
                    style: {
                        width: "100px"
                    }
                },
                text: 'Xóa'
            });
        sym.onmouseover = con.onmouseover = function(sym, con) {
            return function(event, me) {
                sym.style.color = "black";
                con.style.color = "black";
            }
        }(sym, con);
        sym.onmouseout = con.onmouseout = function(sym, con) {
            return function(event, me) {
                sym.style.color = "#929292";
                con.style.color = "#929292";
            }
        }(sym, con);
        list.push({
            attrs: {
                style: {
                    width: "170px"
                }
            },
            symbol: sym,
            content: con,
            onclick: function(id, host) {
                return function(event, me) {
                    blackTheme.reporter_examinations.removeExamination(id);
                    DOMElement.cancelEvent(event);
                    return false;
                }
            }(data_module.examinations.items[i].id, host)
        });
        h = DOMElement.choicelist({
            textcolor: "#929292",
            align: "right",
            symbolattrs: {
                style: {
                    width: "40px"
                }
            },
            list: list
        });
        celldata.push({
            attrs: {
                style: {
                    width: "40px",
                    textAlign: "center"
                }
            },
            children: [
                DOMElement.i({
                    attrs: {
                        className: "material-icons " + DOMElement.dropdownclass.button,
                        style: {
                            fontSize: "20px",
                            cursor: "pointer",
                            color: "#929292"
                        },
                        onmouseover: function(event, me) {
                            me.style.color = "black";
                        },
                        onmouseout: function(event, me) {
                            me.style.color = "#929292";
                        },
                        onclick: function(host1) {
                            return function(event, me) {
                                host1.toggle();
                                DOMElement.cancelEvent(event);
                                return false;
                            }
                        }(h)
                    },
                    text: "more_vert"
                }), h
            ]
        });
        data.push(celldata);
    }
    return data;
}

blackTheme.reporter_examinations.functionChoice = function(event, me, index, parent, data, row)
{
    var self = this;
    var arr =  self.getElementsByClassName("choice-list-category");
    if(arr.length!==0)
    arr = arr[0];
    var today  = new Date();
    if(self.clickTime === undefined)
    self.clickTime = 0;
    if(arr == row&&today - self.clickTime< 300){
        self.selfRemove();
        self.resolve({event:event, me:me, index:index, parent:parent, data:data, row:row});
    }
    self.clickTime = today;
    if(arr.length!==0)
    arr.classList.remove("choice-list-category");

    row.classList.add("choice-list-category");
}

blackTheme.reporter_examinations.addExamination = function(host){
    var self = this;
    var temp = absol.buildDom({
        tag:'singlepage',
        child:[
            {
                class: 'absol-single-page-header',
                child:[
                    {
                        tag: "i2flexiconbutton",
                        on: {
                            click: function(evt) {
                                temp.selfRemove();
                                var arr=host.frameList.getAllChild();
                                host.frameList.activeFrame(arr[arr.length-1]);
                            }
                        },
                        child: [{
                                tag: 'i',
                                class: 'material-icons',
                                props: {
                                    innerHTML: 'save'
                                },
                            },
                            '<span>' + "Đóng" + '</span>'
                        ]
                    },
                    {
                        tag: "i2flexiconbutton",
                        on: {
                            click: function(evt) {
                                var paramEdit = temp.getDataSave();
                                data_module.examinations.addOne(paramEdit)
                                    .then(function() {
                                    })
                            }
                        },
                        child: [{
                                tag: 'i',
                                class: 'material-icons',
                                props: {
                                    innerHTML: 'save'
                                },
                            },
                            '<span>' + "Lưu" + '</span>'
                        ]
                    },
                    {
                        tag: "i2flexiconbutton",
                        on: {
                            click: function(evt) {
                                var paramEdit = temp.getDataSave();
                                data_module.examinations.addOne(paramEdit)
                                    .then(function() {
                                        temp.selfRemove();
                                        var arr=host.frameList.getAllChild();
                                        host.frameList.activeFrame(arr[arr.length-1]);
                                    })


                            }
                        },
                        child: [{
                                tag: 'i',
                                class: 'material-icons',
                                props: {
                                    innerHTML: 'save'
                                },
                            },
                            '<span>' + "Lưu và đóng" +
                            '</span>'
                        ]
                    }
                ]
            },
            {
                class: 'absol-single-page-footer'
            }
        ]})
    var itemsSurvey = [];
    for(var i = 0 ;i<data_module.survey.items.length;i++)
    {
        if(!data_module.survey.items[i].practice)
        itemsSurvey.push({text:data_module.survey.items[i].value,value:data_module.survey.items[i].id});
    }

    var header = [
        {value:'Tên',sort:true,style:{minWidth:"unset"}},
        {value:'Thời gian linh hoạt',sort:true,style:{minWidth:"200px",width:"200px"}},
        {value:'Từ',sort:true,style:{minWidth:"200px",width:"200px"}},
        {value:'Đến',sort:true,style:{minWidth:"200px",width:"200px"}},
        {type:"detail", icon:"",dragElement : false,style:{width:"30px"}}];
        //"remove_circle_outline"
    var mTable =  new window.pizo.tableView(header,[]);
    var checkStudent = [];
    temp.addChild(absol.buildDom({
         tag:"div",
         class:"container-exam-general",
         child:[
            {
                tag:"div",
                class:"container-exam-name",
                child:[
                    {
                        tag:"span",
                        class:"containerr-exam-name-label",
                        props:{
                            innerHTML:"Tên đợt kiểm tra"
                        }
                    },
                    {
                        tag:"input",
                        class:"containerr-exam-name-input",
                    },
                ]
            },
            {
                tag:"div",
                class:"container-exam-survey",
                child:[
                    {
                        tag:"span",
                        class:"container-exam-survey-label",
                        props:{
                            innerHTML:"Bài kiểm tra"
                        }
                    },
                    {
                        tag:"selectmenu",
                        class:"container-exam-survey-selectbox",
                        props:{
                            items:itemsSurvey
                        }
                    }
                ]
            },
            {
                tag:"div",
                class:"container-start-end",
                child:[
                    {
                        tag:"span",
                        class:"container-start-end-label",
                        props:{
                            innerHTML:"Thời gian bắt đầu làm bài kiểm tra"
                        }
                    },
                    {
                        tag:"div",
                        class:"container-start-end-form",
                        child:[
                            {
                                tag:"timeinput",
                                class:"container-start-end-form-time",
                            },
                            {
                                tag:"dateinput",
                                class:"container-start-end-form-date",
                            },
                        ]
                    },
                    {
                        tag:"div",
                        class:"container-start-end-to",
                        child:[
                            {
                                tag:"timeinput",
                                class:"container-start-end-to-time",
                            },
                            {
                                tag:"dateinput",
                                class:"container-start-end-to-date",
                            },
                        ]
                    }
                ]
            },
            {
                tag:"div",
                class:"container-longtime",
                child:[
                    {
                        tag:"span",
                        class:"container-longtime-label",
                        props:{
                            innerHTML:"Thời lượng bài kiểm tra"
                        }
                    },
                    {
                        tag:"timeinput",
                        class:"container-longtime-input",
                    }
                ]
            },
            {
                tag:"div",
                class:"container-student",
                child:[
                    {
                        tag:"span",
                        class:"container-student-label",
                        props:{
                            innerHTML:"Thí sinh"
                        }
                    },
                    {
                        tag:"div",
                        class:"container-student-container",
                        child:[
                            mTable,
                            {
                                tag:"span",
                                class:"container-student-container-addText",
                                on:{
                                    click:function(event)
                                    {
                                        var promiseAll = [];
                                        data_module.usersList.load().then(function(result){
                                            var result = [];
                                            for(var i = 0;i<data_module.usersList.items.length;i++)
                                            {
                                                if(checkStudent[data_module.usersList.items[i].id] == undefined || checkStudent[data_module.usersList.items[i].id].visiable == false)
                                                result.push(data_module.usersList.items[i]);
                                            }
                                            var modalChoice = self.modalChoiceUser(result);
                                            document.body.appendChild(modalChoice);
                                            modalChoice.promiseSelectList.then(function(selectList){
                                                for(var i = 0;i<selectList.length;i++)
                                                {
                                                    if(checkStudent[selectList[i].original.id] == undefined)
                                                    checkStudent[selectList[i].original.id] = self.formatDataStudent(selectList[i],mTable,checkStudent);

                                                    checkStudent[selectList[i].original.id].visiable = true;
                                                    mTable.insertRow(checkStudent[selectList[i].original.id]);
                                                }
                                            });
                                        })
                                    }
                                },
                                props:{
                                    innerHTML:"Thêm"
                                }
                            }
                        ]
                    }
                ]
            }
         ]
     }))
    var $ = absol.$;
    temp.nameInput = $("input.containerr-exam-name-input",temp);
    temp.surveyInput = $(".container-exam-survey-selectbox",temp);
    temp.startInputTime = $(".container-start-end-form-time",temp);
    temp.startInputDate = $(".container-start-end-form-date",temp);
    temp.endInputTime = $(".container-start-end-to-time",temp);
    temp.endInputDate = $(".container-start-end-to-date",temp);
    temp.longInputTime = $(".container-longtime-input",temp);

    temp.getDataSave = function(){
        var dataStudent = [];
        for(var i = 0;i<mTable.data.length;i++)
        {
            dataStudent.push({
                user_id:mTable.data[i].original.id,
                start:mTable.data[i].getTimeStart(),
                end:mTable.data[i].getTimeEnd()
            })
        }
        var startTime;
        if(temp.startInputTime.dayOffset!=null&&temp.startInputDate.value!=null)
        startTime = temp.startInputTime.dayOffset+temp.startInputDate.value.getTime();
        else
        startTime = false;
        var endTime;
        if(temp.endInputTime.dayOffset!=null&&temp.endInputDate.value!=null)
        endTime = temp.endInputTime.dayOffset+temp.endInputDate.value.getTime();
        else
        endTime = false;
        var result = [
            {name:"name",value:this.nameInput.value},
            {name:"surveyid",value:this.surveyInput.value},
            {name:"start",value:EncodingClass.string.fromVariable(new Date(startTime))},
            {name:"end",value:EncodingClass.string.fromVariable(new Date(endTime))},
            {name:"longtime",value:temp.longInputTime.dayOffset},
            {name:"examination_user",value:dataStudent}
        ];
        return result;
    }
    formTest.menu.footer(absol.$('.absol-single-page-footer', temp));
    return temp;
}

blackTheme.reporter_examinations.formatDataStudent = function(data,checkStudent){
    var start = absol._({
        tag:"div",
        class:"container-student-container-start",
        style:{
            display:"none"
        },
        child:[
            {
                tag:"timeinput",
                class:"container-student-container-start-time",
            },
            {
                tag:"dateinput",
                class:"container-student-container-start-date",
            }
        ]
    });
    var end = absol._({
        tag:"div",
        class:"container-student-container-end",
        style:{
            display:"none"
        },
        child:[
            {
                tag:"timeinput",
                class:"container-student-container-end-time",
            },
            {
                tag:"dateinput",
                class:"container-student-container-end-date",
            }
        ]
    });
    var checkboxInput = absol._({
        tag:"checkbox",
        class:"container-student-container-selectbox",
        on:{
            change:function(){
                if(this.checked)
                {
                    start.style.display = "";
                    end.style.display = "";
                }else
                {
                    start.style.display = "none";
                    end.style.display = "none";
                }
            }
        }
    });
    var result = [
        data[2]+" ("+data[1]+")",
        {
            element:checkboxInput
        },
        {
            element:start
        },
        {
            element:end
        },
        {icon:"remove_circle_outline",functionClick:function(){
            checkStudent[data.original.id].visiable = false;
            arguments[3].dropRow(arguments[2])
        }}
    ];
    result.getTimeStart = function()
    {
        if(checkboxInput.checked&&start.childNodes[0].dayOffset != null&&start.childNodes[1].value != null)
        {
            return start.childNodes[0].dayOffset+start.childNodes[1].value.getTime();
        }
        return false;
    }
    result.getTimeEnd = function()
    {
        if(checkboxInput.checked&&end.childNodes[0].dayOffset != null&&end.childNodes[1].value != null)
        {
            return end.childNodes[0].dayOffset+end.childNodes[1].value.getTime();
        }
        return false;
    }
    result.original = data.original;
    if(data.linkData)
    {
        if(data.linkData.start.getTime()!==0||data.linkData.end.getTime()!==0)
        {
            checkboxInput.checked = true;
            checkboxInput.emit("change");
            start.childNodes[0].dayOffset = (data.linkData.start-absol.datetime.beginOfDay(data.linkData.start)) 
            start.childNodes[1].value = absol.datetime.beginOfDay(data.linkData.start);
            end.childNodes[0].dayOffset = (data.linkData.end-absol.datetime.beginOfDay(data.linkData.end))
            end.childNodes[1].value  =absol.datetime.beginOfDay(data.linkData.end);
        }
    }
    return result;
}

blackTheme.reporter_examinations.modalChoiceUser = function(data){
    var _ = absol._;
    var self = this;
    var input = _({
        tag:"searchtextinput",
        class:"header-title-search-content",
    })
    var header = [
        {type:"check",classList:"displayNone-span",style:{minWidth:"0px",width:"50px"}},
        {value:'Username',sort:true,style:{minWidth:"unset"}},
        {value:'Họ và tên',sort:true,style:{minWidth:"unset"}},
        {value:'Email',sort:true,style:{minWidth:"unset"}},
        {value:'MS',sort:true,style:{minWidth:"50px",width:"50px"}}, 
    ];
    var selectZone = _({
        tag:"selectbox",
        class:"header-title-selectzone-selectbox",
        style:{
            display:"none"
        },
        props:{
            disableClickToFocus:true
        }
    })
    var mTable = new window.pizo.tableView(header, self.formatDataUser(data,selectZone,mTable), false, false, 0);
    var container = _({
        tag:"div",
        class:["list-linkChoice-container"],
        child:[
            {
                tag:"div",
                class:"js-stools-container-bar",
                child:[
                    {
                        tag:"div",
                        class:"header-title-close",
                        child:[
                            {
                                tag:"span",
                                class:"headerheader-title-close-label",
                                props:{
                                    innerHTML:"Chọn thí sinh"
                                }
                            },
                            {
                                tag:"button",
                                class:"headerheader-title-close-button",
                                on:{
                                    click:function(event){
                                        self.modal.selfRemove();
                                        self.modal.reject();
                                    }
                                },
                                child:[
                                    {
                                        tag:"i",
                                        class:["fa", "fa-times"],
                                        style:{
                                            color:"black"
                                        }
                                    }
                                ]
                            }
                        ]
                    },
                    {
                        tag:"div",
                        class:"header-title-selectzone",
                        child:[
                            selectZone
                        ]
                    },
                    {
                        tag:"div",
                        class:"header-title-search",
                        child:[
                            input
                        ]
                    },
                    {
                        tag:"div",
                        class:"header-title-table",
                        child:[
                            mTable
                        ]
                    },
                    {
                        tag:"div",
                        class:"header-footer-button",
                        child:[
                            {
                                tag:"flexiconbutton",
                                class:"header-footer-button-ok",
                                on:{
                                    click:function(event){
                                        self.modal.selfRemove();
                                        self.modal.resolve(mTable.getTrueCheckBox());
                                    }
                                },
                                props:{
                                    text:"OK"
                                }
                            },
                            {
                                tag:"flexiconbutton",
                                class:"header-footer-button-cancel",
                                on:{
                                    click:function(event){
                                        self.modal.selfRemove();
                                        self.modal.reject();
                                    }
                                },
                                props:{
                                    text:"Hủy"
                                }
                            }
                        ]
                    }
                ]
            }
        ]
    })
    self.modal = _({
        tag:"modal",
        class:"list-linkChoice",
        child:[
            container
        ]
    })

   
    mTable.style.width = "100%";
    mTable.addInputSearch(input);
    self.modal.promiseSelectList = new Promise(function(resolve,reject){
        self.modal.resolve = resolve;
        self.modal.reject = reject;
    })
    return self.modal;
}

blackTheme.reporter_examinations.formatDataUser = function(data,selectZone,mTable){
    var tempObject;
    var result = [];
    var pushObject;
    var check = [];
    for(var i = 0;i<data.length;i++)
    {
        tempObject = data_module.usersListHome.getID(data[i].homeid);
        pushObject = [
            {classList:"displayNone-span",functionChange:function(){
                var data = arguments[4].original;
                if(arguments[4][0].value == true)
                {
                    var dataHome = data_module.usersListHome.getID(data.homeid);
                    if(check[data.id]==undefined)
                    {
                        var valueUser = {text:dataHome.fullname+" ("+dataHome.username+")",value:data.id, dataValue:arguments[4][0], element:arguments[1].childNodes[0].childNodes[0]};
                        selectZone.items.push(valueUser);
                        selectZone.items = selectZone.items;
                        selectZone.on("remove",function(event){
                            var dataElement = event.data;
                            if(dataElement.dataValue.value == true)
                            {
                                dataElement.element.update(false);
                            }
                        })
                    }
                    check[data.id] = 1;
                    if(selectZone.values.indexOf(data.id)===-1)
                    {
                        selectZone.values.push(data.id);
                        selectZone.values = selectZone.values;
                    }
                }else
                {
                    var indexSelect = selectZone.values.indexOf(data.id);
                    if(indexSelect!=-1)
                    {
                        selectZone.values.splice(indexSelect,1);
                        selectZone.values = selectZone.values;
                    }
                }
                
                if(selectZone.values.length == 0)
                selectZone.style.display = "none";
                else
                selectZone.style.display = "";
               
            }},
            tempObject.username,
            tempObject.fullname,
            tempObject.email,
            data[i].id,
            {}
        ]
        pushObject.original = data[i];
        result.push(pushObject);
    }
    return result;
}

blackTheme.reporter_examinations.updateExamination = function(host, param, linkData){
    var self = this;
    var linkSurvey = linkData[0][0];
    var linkStudent = linkData[1];
    var startTime = param.start;
    var endTime = param.end;
    var temp = absol.buildDom({
        tag:'singlepage',
        child:[
            {
                class: 'absol-single-page-header',
                child:[
                    {
                        tag: "i2flexiconbutton",
                        on: {
                            click: function(evt) {
                                temp.selfRemove();
                                var arr=host.frameList.getAllChild();
                                host.frameList.activeFrame(arr[arr.length-1]);
                            }
                        },
                        child: [{
                                tag: 'i',
                                class: 'material-icons',
                                props: {
                                    innerHTML: 'save'
                                },
                            },
                            '<span>' + "Đóng" + '</span>'
                        ]
                    },
                    {
                        tag: "i2flexiconbutton",
                        on: {
                            click: function(evt) {
                                var paramEdit = temp.getDataSave();
                                data_module.examinations.updateOne(paramEdit)
                                    .then(function() {
                                    })
                            }
                        },
                        child: [{
                                tag: 'i',
                                class: 'material-icons',
                                props: {
                                    innerHTML: 'save'
                                },
                            },
                            '<span>' + "Lưu" + '</span>'
                        ]
                    },
                    {
                        tag: "i2flexiconbutton",
                        on: {
                            click: function(evt) {
                                var paramEdit = temp.getDataSave();
                                data_module.examinations.updateOne(paramEdit)
                                    .then(function() {
                                        temp.selfRemove();
                                        var arr=host.frameList.getAllChild();
                                        host.frameList.activeFrame(arr[arr.length-1]);
                                    })


                            }
                        },
                        child: [{
                                tag: 'i',
                                class: 'material-icons',
                                props: {
                                    innerHTML: 'save'
                                },
                            },
                            '<span>' + "Lưu và đóng" +
                            '</span>'
                        ]
                    }
                ]
            },
            {
                class: 'absol-single-page-footer'
            }
        ]})
    var itemsSurvey = [];
    for(var i = 0 ;i<data_module.survey.items.length;i++)
    {
        if(!data_module.survey.items[i].practice)
        itemsSurvey.push({text:data_module.survey.items[i].value,value:data_module.survey.items[i].id});
    }

    var header = [
        {value:'Tên',sort:true,style:{minWidth:"unset"}},
        {value:'Thời gian linh hoạt',sort:true,style:{minWidth:"200px",width:"200px"}},
        {value:'Từ',sort:true,style:{minWidth:"200px",width:"200px"}},
        {value:'Đến',sort:true,style:{minWidth:"200px",width:"200px"}},
        {type:"detail", icon:"",dragElement : false,style:{width:"30px"}}];
        //"remove_circle_outline"
    var resultStudent = [];
    var checkStudent = [];
    var mTable;
    for(var i=0;i<linkStudent.length;i++)
    {
        var user = data_module.usersList.getID(linkStudent[i].user_id);
        var userHome = data_module.usersListHome.getID(user.homeid);
        var tempData = {
            1:userHome.username,
            2:userHome.fullname
        }
        tempData.original = user;
        tempData.linkData = linkStudent[i];
        checkStudent[linkStudent[i].user_id] = this.formatDataStudent(tempData,checkStudent);
        checkStudent[linkStudent[i].user_id].visiable = true;
        resultStudent.push(checkStudent[linkStudent[i].user_id]);
    }
    mTable =  new window.pizo.tableView(header,resultStudent);
    temp.addChild(absol.buildDom({
         tag:"div",
         class:"container-exam-general",
         child:[
            {
                tag:"div",
                class:"container-exam-name",
                child:[
                    {
                        tag:"span",
                        class:"containerr-exam-name-label",
                        props:{
                            innerHTML:"Tên đợt kiểm tra"
                        }
                    },
                    {
                        tag:"input",
                        class:"containerr-exam-name-input",
                        props:{
                            value:param.name
                        }
                    },
                ]
            },
            {
                tag:"div",
                class:"container-exam-survey",
                child:[
                    {
                        tag:"span",
                        class:"container-exam-survey-label",
                        props:{
                            innerHTML:"Bài kiểm tra"
                        }
                    },
                    {
                        tag:"selectmenu",
                        class:"container-exam-survey-selectbox",
                        props:{
                            items:itemsSurvey,
                            value:linkSurvey.surveyid
                        }
                    }
                ]
            },
            {
                tag:"div",
                class:"container-start-end",
                child:[
                    {
                        tag:"span",
                        class:"container-start-end-label",
                        props:{
                            innerHTML:"Thời gian bắt đầu làm bài kiểm tra"
                        }
                    },
                    {
                        tag:"div",
                        class:"container-start-end-form",
                        child:[
                            {
                                tag:"timeinput",
                                class:"container-start-end-form-time",
                                props:{
                                    dayOffset:(startTime-absol.datetime.beginOfDay(startTime))
                                }

                            },
                            {
                                tag:"dateinput",
                                class:"container-start-end-form-date",
                                props:{
                                    value:absol.datetime.beginOfDay(startTime)
                                }
                            },
                        ]
                    },
                    {
                        tag:"div",
                        class:"container-start-end-to",
                        child:[
                            {
                                tag:"timeinput",
                                class:"container-start-end-to-time",
                                props:{
                                    dayOffset:(endTime-absol.datetime.beginOfDay(endTime))
                                }
                            },
                            {
                                tag:"dateinput",
                                class:"container-start-end-to-date",
                                props:{
                                    value:absol.datetime.beginOfDay(endTime)
                                }
                            },
                        ]
                    }
                ]
            },
            {
                tag:"div",
                class:"container-longtime",
                child:[
                    {
                        tag:"span",
                        class:"container-longtime-label",
                        props:{
                            innerHTML:"Thời lượng bài kiểm tra"
                        }
                    },
                    {
                        tag:"timeinput",
                        class:"container-longtime-input",
                        props:{
                            dayOffset:linkSurvey.longtime
                        }
                    }
                ]
            },
            {
                tag:"div",
                class:"container-student",
                child:[
                    {
                        tag:"span",
                        class:"container-student-label",
                        props:{
                            innerHTML:"Thí sinh"
                        }
                    },
                    {
                        tag:"div",
                        class:"container-student-container",
                        child:[
                            mTable,
                            {
                                tag:"span",
                                class:"container-student-container-addText",
                                on:{
                                    click:function(event)
                                    {
                                        var promiseAll = [];
                                        data_module.usersList.load().then(function(result){
                                            var result = [];
                                            for(var i = 0;i<data_module.usersList.items.length;i++)
                                            {
                                                if(checkStudent[data_module.usersList.items[i].id] == undefined || checkStudent[data_module.usersList.items[i].id].visiable == false)
                                                result.push(data_module.usersList.items[i]);
                                            }
                                            var modalChoice = self.modalChoiceUser(result);
                                            document.body.appendChild(modalChoice);
                                            modalChoice.promiseSelectList.then(function(selectList){
                                                for(var i = 0;i<selectList.length;i++)
                                                {
                                                    if(checkStudent[selectList[i].original.id] == undefined)
                                                    checkStudent[selectList[i].original.id] = self.formatDataStudent(selectList[i],checkStudent);

                                                    checkStudent[selectList[i].original.id].visiable = true;
                                                    mTable.insertRow(checkStudent[selectList[i].original.id]);
                                                }
                                            });
                                        })
                                    }
                                },
                                props:{
                                    innerHTML:"Thêm"
                                }
                            }
                        ]
                    }
                ]
            }
         ]
     }))
    var $ = absol.$;
    temp.nameInput = $("input.containerr-exam-name-input",temp);
    temp.surveyInput = $(".container-exam-survey-selectbox",temp);
    temp.startInputTime = $(".container-start-end-form-time",temp);
    temp.startInputDate = $(".container-start-end-form-date",temp);
    temp.endInputTime = $(".container-start-end-to-time",temp);
    temp.endInputDate = $(".container-start-end-to-date",temp);
    temp.longInputTime = $(".container-longtime-input",temp);

    temp.getDataSave = function(){
        var dataStudent = [];
        for(var i = 0;i<mTable.data.length;i++)
        {
            dataStudent.push({
                user_id:mTable.data[i].original.id,
                start:mTable.data[i].getTimeStart(),
                end:mTable.data[i].getTimeEnd()
            })
        }
        var startTime;
        if(temp.startInputTime.dayOffset!=null&&temp.startInputDate.value!=null)
        startTime = temp.startInputTime.dayOffset+temp.startInputDate.value.getTime();
        else
        startTime = false;
        var endTime;
        if(temp.endInputTime.dayOffset!=null&&temp.endInputDate.value!=null)
        endTime = temp.endInputTime.dayOffset+temp.endInputDate.value.getTime();
        else
        endTime = false;
        var result = [
            {name:"name",value:this.nameInput.value},
            {name:"surveyid",value:this.surveyInput.value},
            {name:"start",value:EncodingClass.string.fromVariable(new Date(startTime))},
            {name:"end",value:EncodingClass.string.fromVariable(new Date(endTime))},
            {name:"longtime",value:temp.longInputTime.dayOffset},
            {name:"examination_user",value:dataStudent},
            {name:"id", value:param.id},
        ];
        return result;
    }
    formTest.menu.footer(absol.$('.absol-single-page-footer', temp));
    return temp;
}

blackTheme.reporter_examinations.removeExamination = function(id) {
    ModalElement.question({
        title: 'Xóa bài khảo sát',
        message: 'Bạn có chắc muốn xóa : ' + "" + data_module.examinations.getById(id).name,
        choicelist: [
                {
                    text: "Đồng ý"
                },
                {
                    text: "Hủy"
                }
        ],
        onclick: function(id) {
            return function(selectedindex) {
                switch (selectedindex) {
                    case 0:
                        data_module.examinations.removeOne(id);
                        break;
                    case 1:
                        // do nothing
                        break;
                }
            }
        }(id)
    });
}

blackTheme.reporter_type_surveys.generateTableDatatype_survey = function(host)
{
    var data = [];
    var celldata = [];
    var indexlist = [];
    var temp;
    var i, k, sym, con;

    for (i = 0; i < data_module.type.items.length; i++) {
        indexlist.push(i);
    }
    for (k = 0; k < data_module.type.items.length; k++) {
        i = indexlist[k];
        celldata = [k + 1];
        celldata.push({
            text: data_module.type.items[i].value
        });
        list = [];

        if (true) {
            sym = DOMElement.i({
                attrs: {
                    className: "material-icons",
                    style: {
                        fontSize: "20px",
                        color: "#929292"
                    }
                },
                text: "mode_edit"
            });
            con = DOMElement.div({
                attrs: {
                    style: {
                        width: "100px"
                    }
                },
                text: 'Sửa'
            });
            sym.onmouseover = con.onmouseover = function(sym, con) {
                return function(event, me) {
                    sym.style.color = "black";
                    con.style.color = "black";
                }
            }(sym, con);
            sym.onmouseout = con.onmouseout = function(sym, con) {
                return function(event, me) {
                    sym.style.color = "#929292";
                    con.style.color = "#929292";
                }
            }(sym, con);
            list.push({
                attrs: {
                    style: {
                        width: "170px"
                    }
                },
                symbol: sym,
                content: con,
                onclick: function(tempabc, index, host) {
                    return function(){
                        var temp1 = blackTheme.reporter_type_surveys.updateType(host,tempabc);
                        host.frameList.addChild(temp1);
                        host.frameList.activeFrame(temp1);
                        DOMElement.cancelEvent(event);
                        return false;
                    }
                }(data_module.type.items[i], i, host)
            });
        }
        sym = DOMElement.i({
                attrs: {
                    className: "material-icons",
                    style: {
                        fontSize: "20px",
                        color: "#929292"
                    }
                },
                text: "delete_sweep"
            }),
        con = DOMElement.div({
                attrs: {
                    style: {
                        width: "100px"
                    }
                },
                text: 'Xóa'
            });
        sym.onmouseover = con.onmouseover = function(sym, con) {
            return function(event, me) {
                sym.style.color = "black";
                con.style.color = "black";
            }
        }(sym, con);
        sym.onmouseout = con.onmouseout = function(sym, con) {
            return function(event, me) {
                sym.style.color = "#929292";
                con.style.color = "#929292";
            }
        }(sym, con);
        list.push({
            attrs: {
                style: {
                    width: "170px"
                }
            },
            symbol: sym,
            content: con,
            onclick: function(id, host) {
                return function(event, me) {
                    blackTheme.reporter_type_surveys.removeType(id);
                    DOMElement.cancelEvent(event);
                    return false;
                }
            }(data_module.type.items[i].id, host)
        });
        h = DOMElement.choicelist({
            textcolor: "#929292",
            align: "right",
            symbolattrs: {
                style: {
                    width: "40px"
                }
            },
            list: list
        });
        celldata.push({
            attrs: {
                style: {
                    width: "40px",
                    textAlign: "center"
                }
            },
            children: [
                DOMElement.i({
                    attrs: {
                        className: "material-icons " + DOMElement.dropdownclass.button,
                        style: {
                            fontSize: "20px",
                            cursor: "pointer",
                            color: "#929292"
                        },
                        onmouseover: function(event, me) {
                            me.style.color = "black";
                        },
                        onmouseout: function(event, me) {
                            me.style.color = "#929292";
                        },
                        onclick: function(host1) {
                            return function(event, me) {
                                host1.toggle();
                                DOMElement.cancelEvent(event);
                                return false;
                            }
                        }(h)
                    },
                    text: "more_vert"
                }), h
            ]
        });
        data.push(celldata);
    }
    return data;
}

blackTheme.reporter_type_surveys.addType = function(host){
    var name = formTestComponent.spanInput("Tên", "");
    var note = formTestComponent.spanInput("Ghi chú", "", false);
    var temp = absol.buildDom({
        tag:'singlepage',
        child:[
            {
                class: 'absol-single-page-header',
                child:[
                    {
                        tag: "i2flexiconbutton",
                        on: {
                            click: function(evt) {
                                temp.selfRemove();
                                var arr=host.frameList.getAllChild();
                                host.frameList.activeFrame(arr[arr.length-1]);
                            }
                        },
                        child: [{
                                tag: 'i',
                                class: 'material-icons',
                                props: {
                                    innerHTML: 'save'
                                },
                            },
                            '<span>' + "Đóng" + '</span>'
                        ]
                    },
                    {
                        tag: "i2flexiconbutton",
                        on: {
                            click: function(evt) {
                                var paramEdit = [
                                    {
                                        name: "value",
                                        value: name.childNodes[1].value
                                    },
                                    {
                                        name: "note",
                                        value: note.childNodes[1].value,
                                    }
                                ]
                                data_module.type.addOne(paramEdit)
                                    .then(function() {
                                    })


                            }
                        },
                        child: [{
                                tag: 'i',
                                class: 'material-icons',
                                props: {
                                    innerHTML: 'save'
                                },
                            },
                            '<span>' + "Lưu" + '</span>'
                        ]
                    },
                    {
                        tag: "i2flexiconbutton",
                        on: {
                            click: function(evt) {
                                var paramEdit = [
                                    {
                                        name: "value",
                                        value: name.childNodes[1].value,
                                    },
                                    {
                                        name: "note",
                                        value: note.childNodes[1].value,
                                    }
                                ]
                                data_module.type.addOne(paramEdit)
                                    .then(function() {
                                        temp.selfRemove();
                                        var arr=host.frameList.getAllChild();
                                        host.frameList.activeFrame(arr[arr.length-1]);
                                    })


                            }
                        },
                        child: [{
                                tag: 'i',
                                class: 'material-icons',
                                props: {
                                    innerHTML: 'save'
                                },
                            },
                            '<span>' + "Lưu và đóng" +
                            '</span>'
                        ]
                    }
                ]
            },
            {
                class: 'absol-single-page-footer'
            }
        ]})
     temp.addChild(DOMElement.div({
                attrs: {
                    className: "update-catergory",
                    style: {},
                },
                children: [
                    name,
                    note
                ]
            }))
    formTest.menu.footer(absol.$('.absol-single-page-footer', temp));
    return temp;
}

blackTheme.reporter_type_surveys.updateType = function(host, param) {
    var name = formTestComponent.spanInput("Tên", param.value);
    var note = formTestComponent.spanInput("Ghi chú", param.note, false);
    var temp = absol.buildDom({
        tag:'singlepage',
        child:[
            {
                class: 'absol-single-page-header',
                child:[
                    {
                        tag: "i2flexiconbutton",
                        on: {
                            click: function(evt) {
                                temp.selfRemove();
                                var arr=host.frameList.getAllChild();
                                host.frameList.activeFrame(arr[arr.length-1]);
                            }
                        },
                        child: [{
                                tag: 'i',
                                class: 'material-icons',
                                props: {
                                    innerHTML: 'save'
                                },
                            },
                            '<span>' + "Đóng" + '</span>'
                        ]
                    },
                    {
                        tag: "i2flexiconbutton",
                        on: {
                            click: function(evt) {
                                var paramEdit = [{
                                        name: "id",
                                        value: param.id
                                    },
                                    {
                                        name: "value",
                                        value: name.childNodes[1].value
                                    },
                                    {
                                        name: "note",
                                        value: note.childNodes[1].value,
                                    }
                                ]
                                data_module.type.updateOne(paramEdit)
                                    .then(function() {
                                    })


                            }
                        },
                        child: [{
                                tag: 'i',
                                class: 'material-icons',
                                props: {
                                    innerHTML: 'save'
                                },
                            },
                            '<span>' + "Lưu" + '</span>'
                        ]
                    },
                    {
                        tag: "i2flexiconbutton",
                        on: {
                            click: function(evt) {
                                var paramEdit = [{
                                        name: "id",
                                        value: param.id
                                    },
                                    {
                                        name: "value",
                                        value: name.childNodes[1].value
                                    },
                                    {
                                        name: "note",
                                        value: note.childNodes[1].value,
                                    }
                                ]
                                data_module.type.updateOne(paramEdit)
                                    .then(function() {
                                        temp.selfRemove();
                                        var arr=host.frameList.getAllChild();
                                        host.frameList.activeFrame(arr[arr.length-1]);
                                    })


                            }
                        },
                        child: [{
                                tag: 'i',
                                class: 'material-icons',
                                props: {
                                    innerHTML: 'save'
                                },
                            },
                            '<span>' + "Lưu và đóng" +
                            '</span>'
                        ]
                    }
                ]
            },
            {
                class: 'absol-single-page-footer'
            }
        ]})
        formTest.menu.footer(absol.$('.absol-single-page-footer', temp));
        temp.addChild(DOMElement.div({
                attrs: {
                    className: "update-catergory",
                },
                children: [
                    name,
                    note
                ]
            }));
    return temp;
}

blackTheme.reporter_type_surveys.removeType= function(id) {
    ModalElement.question({
        title: 'Xóa bài khảo sát',
        message: 'Bạn có chắc muốn xóa : ' + "" + data_module.type.getById(id).value,
        choicelist: [
                {
                    text: "Đồng ý"
                },
                {
                    text: "Hủy"
                }
        ],
        onclick: function(id) {
            return function(selectedindex) {
                switch (selectedindex) {
                    case 0:
                        data_module.type.removeOne(id);
                        break;
                    case 1:
                        // do nothing
                        break;
                }
            }
        }(id)
    });
}

blackTheme.reporter_questions.removequestion = function(text) {
    return new Promise(function(resolve,reject){
            ModalElement.question({
            title: 'Xóa câu hỏi',
            message: 'Bạn có chắc muốn xóa câu hỏi : ' + '"' + text+'"',
            choicelist: [
                    {
                        text: "Đồng ý"
                    },
                    {
                        text: "Hủy"
                    }
            ],
            onclick: function(text) {
                return function(selectedindex) {
                    switch (selectedindex) {
                        case 0:
                            resolve();
                            break;
                        case 1:
                            reject();
                            break;
                    }
                }
            }(text)
        });
    });
}

blackTheme.reporter_users.generateTableDataUsers = function(host) {

var data = [];
var celldata = [];
var indexlist = [];
var temp;
var i, k, sym, con;
var array = []
array = data_module.usersList.items
var stringCategory;

for (i = 0; i < array.length; i++) {
    indexlist.push(i);
}
var stringPrivilege;
var stringPrivilegeAccount;
var stringAvailable;

for (k = 0; k < array.length; k++) {
    i = indexlist[k];
    stringPrivilege = LanguageModule.text("txt_no");
    stringPrivilegeAccount = LanguageModule.text("txt_no");
    stringAvailable = LanguageModule.text("txt_no");
    if (array[i].privilege !== 0) {
        stringPrivilege = LanguageModule.text("txt_yes");
        if (array[i].privilege !== 1)
            stringPrivilegeAccount = LanguageModule.text("txt_yes");
    } else {

    }
    if (array[i].available !== 0)
        stringAvailable = LanguageModule.text("txt_yes");
    celldata = [k + 1];
    celldata.push({
        text: data_module.usersListHome.getID(array[i].homeid).username
    });
    celldata.push({
        text: data_module.usersListHome.getID(array[i].homeid).fullname
    });
    celldata.push({
        text: data_module.usersListHome.getID(array[i].homeid).email
    });
    celldata.push({
        text: formTestComponent.formatDate(array[i].privupdate) +" "+ formTestComponent.formatHour(array[i].privupdate)
    });
    celldata.push({
        text: stringPrivilege
    });
    celldata.push({
        text: stringPrivilegeAccount
    });
    celldata.push({
        text: stringAvailable
    });
    celldata.push({
        text: array[i].language
    });
    celldata.push({
        text: array[i].comment
    });
    list = [];
    if (true) {
        sym = DOMElement.i({
            attrs: {
                className: "material-icons",
                style: {
                    fontSize: "20px",
                    color: "#929292"
                }
            },

            text: "mode_edit"
        });
        con = DOMElement.div({
            attrs: {
                style: {
                    width: "100px"
                }
            },
            text: LanguageModule.text("ctrl_edit")
        });
        sym.onmouseover = con.onmouseover = function(sym, con) {
            return function(event, me) {
                sym.style.color = "black";
                con.style.color = "black";
            }
        }(sym, con);
        sym.onmouseout = con.onmouseout = function(sym, con) {
            return function(event, me) {
                sym.style.color = "#929292";
                con.style.color = "#929292";
            }
        }(sym, con);
        list.push({
            attrs: {
                style: {
                    width: "170px"
                }
            },
            symbol: sym,
            content: con,
            onclick: function(tempabc) {
                return function(event, me) {
                    //to do something o day'

                    var temp1 = formTestComponent.formAddUser(host, tempabc);
                    host.frameList.addChild(temp1);
                    host.frameList.activeFrame(temp1);
                    DOMElement.cancelEvent(event);
                    return false;
                }
            }(array[i])
        });

    }
    sym = DOMElement.i({
            attrs: {
                className: "material-icons",
                style: {
                    fontSize: "20px",
                    color: "#929292"
                }
            },
            text: "delete"
        }),
        con = DOMElement.div({
            attrs: {
                style: {
                    width: "100px"
                }
            },
            text: LanguageModule.text("ctrl_delete")
        });
    sym.onmouseover = con.onmouseover = function(sym, con) {
        return function(event, me) {
            sym.style.color = "red";
            con.style.color = "black";
        }
    }(sym, con);
    sym.onmouseout = con.onmouseout = function(sym, con) {
        return function(event, me) {
            sym.style.color = "#929292";
            con.style.color = "#929292";
        }
    }(sym, con);
    list.push({
        attrs: {
            style: {
                width: "170px"
            }
        },
        symbol: sym,
        content: con,
        onclick: function(id, host) {
            return function(event, me) {
                blackTheme.reporter_users.removeUser(host, id);
                DOMElement.cancelEvent(event);
                return false;
            }
        }(array[i].id, host)
    });
    h = DOMElement.choicelist({
        textcolor: "#929292",
        align: "right",
        symbolattrs: {
            style: {
                width: "40px"
            }
        },
        list: list
    });
    // h.style.position = "absolute";
    // h.style.marginTop = "-110px";
    // h.style.marginLeft = "-10px";
    celldata.push({
        attrs: {
            style: {
                width: "40px",
                textAlign: "center"
            }
        },
        children: [
            DOMElement.i({
                attrs: {
                    className: "material-icons " + DOMElement.dropdownclass.button,
                    style: {
                        fontSize: "20px",
                        cursor: "pointer",
                        color: "#929292"
                    },
                    onmouseover: function(event, me) {
                        me.style.color = "black";
                    },
                    onmouseout: function(event, me) {
                        me.style.color = "#929292";
                    },
                    onclick: function(host) {
                        return function(event, me) {
                            host.toggle();
                            DOMElement.cancelEvent(event);
                            return false;
                        }
                    }(h)
                },
                text: "more_vert"
            }), h
        ]
    });
    data.push(celldata);
}
return data;
};

blackTheme.reporter_users.UpdataFunction = function(host) {
    ModalElement.show_loading();
    var param = host.param;
    if (param !== undefined) {
        var paramEdit = [{
                name: "id",
                value: param.homeid
            },
            {
                name: "fullname",
                value: host.fullname.childNodes[1].value
            },
            {
                name: "email",
                value: host.email.childNodes[1].value
            },
        ];
        
        if (host.Password.style.display !== "none"){
         if(host.Password.childNodes[1].value === host.checkPassword.childNodes[1].value&&host.Password.childNodes[1].value!=="")
            paramEdit.push({
                name: "password",
                value: host.Password.childNodes[1].value
            });
            else
            {
                alert("Mật khẩu không hợp lệ hoặc không trùng khớp");
                ModalElement.close(-1);
                return;
            }
        }
        data_module.usersListHome.updateOne(paramEdit).then(function() {
            var paramEditJD = [
                {
                    name: "id",
                    value: param.id
                },
                {
                    name: "privilege",
                    value: host.AdminTrans.childNodes[1].value + host.AdminAccount.childNodes[1]
                        .value
                },
                {
                    name: "language",
                    value: host.language.childNodes[1].value
                },
                {
                    name: "available",
                    value: host.available.childNodes[1].value
                },
                {
                    name: "comment",
                    value: host.comment.childNodes[1].value
                },
                {
                    name: "theme",
                    value: host.theme.childNodes[1].value
                },
            ];
            data_module.usersList.updateOne(paramEditJD).then(function(value) {
                Object.assign(host.param,value);
                host.check.childNodes[1].childNodes[0].setAttribute("disabled","");
                host.check.childNodes[1].style.backgroundColor = "#ebebe4";
                formTest.reporter_users_information.redrawTable(host);
                ModalElement.close(-1);
            });
        });
    } else {
        if(data_module.usersListHome.getName(host.selectChoice.value)!==undefined)
        {
            host.idAccountHome=data_module.usersListHome.getName(host.selectChoice.value).id;
            for(var i =0;i<data_module.usersList.items.length;i++)
            {
                if(data_module.usersList.items[i].homeid == host.idAccountHome)
                {
                alert("Account này đã sử dụng");
                ModalElement.close(-1);
                return;
                }
            }
        }
       
        if (host.idAccountHome === -1) {
            var dt = new Date();
            var paramEdit = [
                {
                    name: "username",
                    value: host.check.childNodes[1].value
                },
                {
                    name: "fullname",
                    value: host.fullname.childNodes[1].value
                },
                {
                    name: "email",
                    value: host.email.childNodes[1].value
                },
                {
                    name: "privilege",
                    value: 0
                },
                {
                    name: "language",
                    value: "VN"
                },
                {
                    name: "available",
                    value: 1
                },
                {
                    name: "comment",
                    value: ""
                },
                {
                    name: "theme",
                    value: 1
                },
                {
                    name: "t_year",
                    value: dt.getYear(),
                }
            ];
            if (host.Password.style.display !== "none"){
                if( host.Password.childNodes[1].value === host.checkPassword.childNodes[1].value&& host.Password.childNodes[1].value!=="")
                    paramEdit.push({
                        name: "password",
                        value: host.Password.childNodes[1].value
                    });
                    else
                    {
                        alert("Mật khẩu không hợp lệ hoặc không trùng khớp");
                        ModalElement.close(-1);
                        return;
                    }
            }
               
                data_module.usersListHome.addOne(paramEdit).then(function(value) {
                    host.idAccountHome = value.id;
                    var paramEditJD = [{
                            name: "privilege",
                            value: host.AdminTrans.childNodes[1].value + host.AdminAccount.childNodes[1]
                                .value
                        },
                        {
                            name: "language",
                            value: host.language.childNodes[1].value
                        },
                        {
                            name: "available",
                            value: host.available.childNodes[1].value
                        },
                        {
                            name: "comment",
                            value: host.comment.childNodes[1].value
                        },
                        {
                            name: "homeid",
                            value: host.idAccountHome
                        },
                        {
                            name: "theme",
                            value: host.theme.childNodes[1].value
                        },
                    ];
                data_module.usersList.addOne(paramEditJD).then(function(value) {
                    formTest.reporter_users_information.redrawTable(host);
                    host.param = value;
                    host.param.id = value.id;
                    host.check.childNodes[1].childNodes[0].setAttribute("disabled","");
                    host.check.childNodes[1].style.backgroundColor = "#ebebe4";
                    ModalElement.close(-1);
                });
            });
        } else {
            var paramEdit = [{
                    name: "id",
                    value: host.idAccountHome
                },
                {
                    name: "fullname",
                    value: host.fullname.childNodes[1].value
                },
                {
                    name: "email",
                    value: host.email.childNodes[1].value
                },
            ];
            if (host.Password.style.display !== "none" )
            {
                if(host.Password.childNodes[1].value === host.checkPassword.childNodes[1].value && host.Password.childNodes[1].value!=="")
                paramEdit.push({
                    name: "password",
                    value: host.Password.childNodes[1].value
                })
                else
                {
                    alert("Mật khẩu không hợp lệ hoặc không trùng khớp");
                    ModalElement.close(-1);
                    return;
                }
            }
                
            data_module.usersListHome.updateOne(paramEdit).then(function() {
                var paramEditJD = [{
                        name: "privilege",
                        value: host.AdminTrans.childNodes[1].value + host.AdminAccount.childNodes[1]
                            .value
                    },
                    {
                        name: "language",
                        value: host.language.childNodes[1].value
                    },
                    {
                        name: "available",
                        value: host.available.childNodes[1].value
                    },
                    {
                        name: "comment",
                        value: host.comment.childNodes[1].value
                    },
                    {
                        name: "homeid",
                        value: host.idAccountHome
                    },
                    {
                        name: "theme",
                        value: host.theme.childNodes[1].value
                    },
                ]
                data_module.usersList.addOne(paramEditJD).then(function(value) {
                    formTest.reporter_users_information.redrawTable(host);
                    host.param = value;
                    host.param.id = value.id;
                    host.check.childNodes[1].childNodes[0].setAttribute("disabled","");
                     host.check.childNodes[1].style.backgroundColor = "#ebebe4";
                    ModalElement.close(-1);
                })
            });
        }

    }
}
blackTheme.reporter_users.removeUser = function(host, id) {
    ModalElement.question({
        title: LanguageModule.text("title_delete_user"),
        message: LanguageModule.text("title_confirm_delete") + "" + data_module.usersListHome.getID(data_module.usersList.getID(id).homeid).username,
        onclick: function(id) {
            return function(selectedindex) {
                switch (selectedindex) {
                    case 0:
                        data_module.usersList.removeOne(id).then(function() {
                            formTest.reporter_users_information.redrawTable(host);
                        })
                        break;
                    case 1:
                        // do nothing
                        break;
                }
            }
        }(id)
    });
};
</script>
<?php
    }
?>