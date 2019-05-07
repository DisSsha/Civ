<?php

namespace app\utils;

class Logger {

    public static function CivEvent($civ,  $type, $obj) {
      $pdo = Database::getInstance();
      if ($type == "tech"){
        $stmt = $pdo->prepare ('
                  INSERT INTO logs
                    (game_id, turn, civ, type, message)
                  VALUES
                    (:game_id, :turn, :civ, :type, :message)
          ');
        $stmt->bindParam(':game_id',$civ->game->turn);
        $stmt->bindParam(':turn',$civ->game->id);
        $stmt->bindParam(':civ',$civ->id);
        $stmt->bindParam(':type',$type);
        $message = "started a new research $obj->name";
        $stmt->bindParam(':message',$message);
        $reply = $stmt->execute();
      }
    }
}
