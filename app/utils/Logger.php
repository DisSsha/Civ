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
        $stmt->bindParam(':turn',$civ->game->turn);
        $stmt->bindParam(':game_id',$civ->game->id);
        $stmt->bindParam(':civ',$civ->id);
        $stmt->bindParam(':type',$type);
        $message = "started a new research $obj->name";
        $stmt->bindParam(':message',$message);
        $reply = $stmt->execute();
      }
    }

    public static function getLogs($game_id){
      $pdo = Database::getInstance();
      $req = "SELECT * from `logs` where game_id=".$game_id." ORDER by turn,civ,type DESC;";
      $reply = $pdo->query($req);
      $data = $reply->fetchAll();
      return $data;
    }
}
