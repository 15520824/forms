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
                    var temp1 = blackTheme.reporter_surveys.addSurvey(host,tempabc.id);
                    host.frameList.addChild(temp1);
                    host.frameList.activeFrame(temp1);
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
                        var temp1 = blackTheme.reporter_examinations.updateExamination(host,tempabc);
                        host.frameList.addChild(temp1);
                        host.frameList.activeFrame(temp1);
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

blackTheme.reporter_examinations.addExamination = function(host){
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
                                var paramEdit;
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
                                var paramEdit;
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
    var functionClickMore = function(){
        console.log("delete",arguments)
    }
    var itemsSurvey = [];
    var dataSurvey = [];
    for(var i = 0 ;i<data_module.survey.items.length;i++)
    {
        itemsSurvey.push({text:data_module.survey.items[i].value,value:data_module.survey.items[i].id});
        dataSurvey[data_module.survey.items[i].id] = [];
    }
    var header = [
        {value:'Tên',sort:true,style:{minWidth:"unset"}},
        {value:'Thời gian linh hoạt',sort:true,style:{minWidth:"200px",width:"200px"}},
        {value:'Từ',sort:true,style:{minWidth:"200px",width:"200px"}},
        {value:'Đến',sort:true,style:{minWidth:"200px",width:"200px"}},
        {type:"detail", functionClickAll:functionClickMore,icon:"",dragElement : false,style:{width:"30px"}}];
        //"remove_circle_outline"
    var mTable =  new window.pizo.tableView(header,[]);
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
                        class:"containerr-exam-name-selectbox",
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

                        on:{
                            click:function(event)
                            {
                                var element = event.target;
                                while(!(element.classList.contains("absol-selectbox-item-close")||element.classList.contains("absol-selectbox-item")||element.classList.contains("absol-selectbox")))
                                element = element.parentNode;
                                if(element.classList.contains("absol-selectbox-item"))
                                {
                                    var selected = absol.$("div.absol-selectbox-item.selectedIItem",this);
                                    if(selected!==undefined)
                                    {
                                        selected.classList.remove("selectedIItem");
                                    }
                                    element.classList.add("selectedIItem");
                                }
        
                            },
                            add:function(event)
                            {

                            },
                            remove:function(event)
                            {
                                if(event.itemElt.classList.contains("selectedIItem"))
                                {
                                    if(this.values.indexOf(0)!==-1)
                                    {
                                        var arrayItem = this.getElementsByClassName("absol-selectbox-item");
                                        for(var i = 0;i<arrayItem.length;i++)
                                        {
                                            if(arrayItem[i].data.value == 0)
                                            {
                                                arrayItem[i].click();
                                                break;
                                            }
                                        }
                                    }else
                                    {
                                        var arrayItem = this.getElementsByClassName("absol-selectbox-item");
                                        if(arrayItem.length)
                                        {
                                            arrayItem[0].click();
                                        }
                                    }
                                }else
                                {
                                    var selected = absol.$("div.absol-selectbox-item.selectedIItem",this);
                                    if(selected!==undefined)
                                    {
                                        selected.click();
                                    }
                                }
                            }
                        },
                        props:{
                            items:itemsSurvey
                        }
                    },
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
                                class:"container-start-end-form-day",
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
                                class:"container-start-end-to-day",
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
                        class:"container-longtime-label",
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

    formTest.menu.footer(absol.$('.absol-single-page-footer', temp));
    return temp;
}

blackTheme.reporter_examinations.updateExamination = function(host, param) {
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

blackTheme.reporter_examinations.removeExamination = function(id) {
    ModalElement.question({
        title: 'Xóa bài khảo sát',
        message: 'Bạn có chắc muốn xóa : ' + "" + data_module.examinations.getById(id).value,
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