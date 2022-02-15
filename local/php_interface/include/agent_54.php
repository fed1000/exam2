<?
// для подбора интервала запуска функции (дату и время) смотреть агента (ов) с интервалом 60 сек
function CheckUserCount(){
    $date = new DateTime();
    //приводим дату к необходимому формату
    $date = \Bitrix\Main\Type\DateTime::createFromTimestamp($date->getTimestamp());
    //получаем из системы записанное свойство
    $lastDate = COption::GetOptionString("main", "last_date_agent_checkUserCount");
    if($lastDate){
        $arFilter = array("DATE_REGISTER_1" => $lastDate);
    }else {
        $arFilter = array();
    }
    //получаем список зарегистрированных пользователей согласно фильтру
    $by = "DATE_REGISTER";
    $order = "ASC";
    $rsUser = CUser::GetList(
        $by,
        $order,
        $arFilter
    );
    $arUsers = array();
    while ($user = $rsUser->Fetch()) {
        $arUsers[] = $user;
    }
    if (!$lastDate) {
        $lastDate = $arUsers[0]["DATE_REGISTER"];
    }
    //получаем разницу в секундах между текущей датой и датой последнего запуска функции
    $difference = intval(abs(strtotime($lastDate) - strtotime($date->toString())));
    //преобразуем секунды в дни
    $days = round($difference / (3600 * 24));
    //получаем количество пользователей
    $countUsers = count($arUsers);
    //получаем всех администраторов
    $by = "ID";
    $order = "ASC";
    $rsAdmin = CUser::GetList(
        $by,
        $order,
        array("GROUPS_ID" => 1)
    );
    while ($admin = $rsAdmin->Fetch()) {
        //отправляем письмо администратору
        CEvent::Send(
            "COUNT_REGISTERED_USERS",
            "s1",
            array(
                "EMAIL_TO" => $admin["EMAIL"],
                "COUNT_USERS" => $countUsers,
                "COUNT_DAYS" => $days,
            ),
            "Y",
            "24"
        );
    }
    COption::SetOptionString("main", "last_date_agent_checkUserCount", $date->toString());
    return "CheckUserCount();";
}