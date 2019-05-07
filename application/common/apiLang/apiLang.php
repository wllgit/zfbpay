<?php
//接口请求接受成功并成功且返回不为空的数据
define('SUCCESS_MESSAGE','操作成功');
define('SAVE_SUCCESS','保存成功');
define('DELETE_SUCCESS','删除成功');
define('ADD_SUCCESS','添加成功');
define('UPDATE_SUCCESS','更新成功');
define('EDIT_SUCCESS','编辑成功');
define('OBTAIN_SUCCESS','获取数据成功');
define('LOGIN_SUCCESS','登录成功');
define('LOGOUT_SUCCESS','退出成功');
define('REGISTER_SUCCESS','注册成功');
define('BIND_SUCCESS','绑定成功');
define('RECALL_SUCCESS','撤回成功');
define('SEND_CODE_SUCCESS','发送验证码成功，请注意查收!');
define('SUCCESS_CODE',200);
define('SUCCESS_STATUS',true);
//接口请求接受成功并成功但返回为空的数据
define('NULL_MESSAGE','获取数据为空');
define('NULL_USER','用户不存在,请先注册绑定');
define('NULL_CODE',204);
define('NULL_STATUS','NULL');
//接口请求接受失败或操作错误
define('DIS_ABLE_FAIL','该用户已被禁用!');
define('OPERATE_FAIL','操作失败,请稍后重试!');
define('NOSUPPORT_OPERATE','暂不支持该操作类型!');
define('ADD_FAIL','添加失败,请稍后重试!');
define('UPDATE_FAIL','更新失败,请稍后重试!');
define('EDIT_FAIL','编辑失败,请稍后重试!');
define('DELETE_FAIL','删除失败,请稍后重试!');
define('LOGIN_FAIL','登录失败,请稍后重试!');
define('LOGOUT_FAIL','登出失败!');
define('BIND_FAIL','绑定失败!');
define('RECALL_FAIL','撤回失败');
define('REGISTER_FAIL','注册失败,请稍后重试!');
define('USER_NAME_EXITED','用户名已存在!');
define('OBTAIN_FAIL','获取数据失败,请稍后重试!');
define('SEND_CODE_FAIL','发送验证码失败,请稍后重试!');
define('CODE_ERROR','验证码错误!');
define('CODE_EXPIRED','验证码已失效!');
define('PASSWORD_ERROR','密码错误!');
define('SIGN_ERROR','签名错误!');
define('LACK_SIGN','缺少签名!');
define('LACK_TIMESTAMP','缺少时间戳!');
define('LACK_SERVICE','缺少设备标识!');
define('LACK_PARAM','缺少参数!');
define('TIME_OUT','请求超时!');
define('TOKEN_ERROR','该账号已在其他设备登录!');
define('TOKEN_EXPIRED','登录已过期,请重新登陆!');
define('LACK_TOKEN','缺少token,非法访问!');
define('ACCESS_DENIED','缺少权限!');
define('TOKEN_EXPIRED_CODE',401);
define('NOT_LOGIN',401);
define('IP_FORBIDDEN','ip forbidden');//禁止访问
define('FORBIDDEN',403);//禁止访问
define('NOT_LOGIN_MSG','用户尚未登录');
define('LACK_MASK_CODE',-300);
define('BAD_MASK_CODE',-301);
define('MASK_ERROR_CODE',-302);
define('LACK_MASK','缺少mask签名!');
define('BAD_MASK','验证信息格式不正确');
define('LACK_ACT','缺少操作类型!');
define('MASK_ERROR_MSG','mask校验失败');
define('FAIL_CODE',-100);
define('LACK_CODE',-101);//缺少验证码code
define('LACK_CODE_MSG','缺少验证码');//缺少验证码
define('FAIL_STATUS',false);
define('ERROR_STATUS','ERROR');
