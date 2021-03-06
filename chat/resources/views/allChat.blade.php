@extends('layouts.app')

@section('script')
    <script src="{{ asset('js/chat.js') }}" ></script>
    <script src="{{ asset('js/chatAg.js') }}" ></script>
    <script src="{{ asset('js/floatBtn.js') }}" ></script>
@endsection


@section('content')
    <div class="row" style="padding-left: 10%; padding-right: 10%; padding-top: 2%;">
        <div class="col-sm-8" style="padding-right: 10%;">
            <div class="col-sm-12 well" style="padding: 0px; border-width: 3px;">
                <div id="list" style="height: 290px;  overflow-y:auto; margin: 0px; padding: 0px;">

                </div>
            </div>
            <div class="col-sm-12 well">
                <div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
                    <button class="btn btn-default" style="position: absolute;" data-toggle="tooltip"
                            data-placement="right">
                        <span class="glyphicon glyphicon-picture"></span>
                    </button>
                    <input class="btn btn-default" id="mesPic" name="mesPic" type="file"
                           onclick="document.getElementById('imgShow').disabled = false;"
                           style="width: 20px;height:20px;opacity: 0;">
                    <button id="imgShow" type="button" class="btn btn-default" style="float: right;" ng-click="showPic()" disabled="true">
                        预览图片
                    </button>
                </div>

                <div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
                    <div id="imgReview"></div>
                    <input id="mes" name="mes" class="col-sm-12 col-xs-12" type="textarea" style="height: 100px;">
                </div>

                <div class="col-sm-12 col-xs-12" style="margin-top: 30px; text-align:center;">
                    <button id="send" class="btn btn-default col-sm-4 col-sm-push-4 col-xs-4 col-xs-push-4 submit" onclick="WebSocketTest()">
                        发送消息
                    </button>
                </div>

            </div>
        </div>
        <div class="col-sm-4 col-xs-4 well" style="padding: 2%;">

            <div class="col-sm-12 col-xs-12" style="margin-top: 20px;">
                <span id="num1" class="col-sm-12">当前在线人数：</span>
            </div>
        </div>
    </div>
@endsection