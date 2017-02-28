<?php
    class main {
        public function GetUsers($city = [], $qualification = [], $limit = 0, $start = 0) {
            $user = [];
            $db = db::GetInit();
			$q = "SELECT `user`.`user_id`, `user`.`name` AS `fio`, `user`.`qualification_id`, `qualification`.`name` AS `qualification_name`, `city`.`city_id`, `city`.`name` AS `city_name` FROM `user` LEFT JOIN `user_citys` ON `user`.`user_id` = `user_citys`.`user_id` LEFT JOIN `qualification` on `user`.`qualification_id` = `qualification`.`qualification_id` LEFT JOIN `city` ON `city`.`city_id` = `user_citys`.`city_id`";
			if(count($city) > 0 || count($qualification) > 0)
				$q .= " WHERE";
			if(count($city) > 0 )
			{
				$q .= "(";
				for($i = 0; $i < count($city); ++$i)
					$q .= "`user_citys`.`city_id` = " .$city[$i].(($i != count($city)-1) ? " OR": "");
				$q .= ")";
			}
			if(count($qualification) > 0)
			{
				if(count($qualification) > 0 ) $q .= " AND";
				$q .= "(";
				for($i = 0; $i < count($qualification); ++$i)
					$q .= "`qualification`.`qualification_id` = " .$qualification[$i].(($i != count($qualification)-1) ? " OR": "");
				$q .= ")";
			}
            if($q = $db->query($q."ORDER BY `user_id`".(($limit != 0) ? "LIMIT $limit": "").(($limit != 0 && $start != 0) ? ", $start" : ""))) {
                while ($row = $db->get_row($q)) {
					if(!array_key_exists($row['user_id'], $user))
						$user[$row['user_id']] = $row;
					$user[$row['user_id']]['city'][$row['city_id']] = $row['city_name'];
					unset($user[$row['user_id']]['city_id']);
					unset($user[$row['user_id']]['city_name']);
                }
            } else  return ['error' => 'Что-то пошло не так!'];
            if(count($user) == 0) return ['error' => 'Нет ни одного человека!'];
            return $user;
        }
        public function GetQualification()
        {
            $qualification = [];
            $db = db::GetInit();
            $q = $db->query("SELECT * FROM `qualification`");
            while ($row = $db->get_row($q))
                $qualification[$row['qualification_id']] = $row['name'];
            return $qualification;
        }
        public function GetCity()
        {
            $city = [];
            $db = db::GetInit();
            $q = $db->query("SELECT * FROM `city`");
            while ($row = $db->get_row($q))
                $city[$row['city_id']] = $row['name'];
            return $city;
        }
    }
