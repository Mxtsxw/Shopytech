<?php
class ReviewsManager extends Model
{
    /**
     * Récupère tous les avis
     * @return array
     */
    public function getReviews() 
    {
        return $this->getAll('reviews','Reviews'); 
    }

    /**
     * Récupère les avis d'un produit via son ID
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function getReviewsByProductId($id)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM reviews WHERE id_product = '. $id);
        $req ->execute();

        $objects = [];
        
        while($data = $req ->fetch(PDO::FETCH_ASSOC))
        {
            $objects[] = new Reviews($data);
        }
        
        $req->closeCursor();

        return $objects; 
    }

    /** 
     * Ajoute un avis dans la base de données
     * @param Reviews $review
     * @return void
     */
    public function addReview(Reviews $review)
    {
        $req = $this->getBdd()->prepare('INSERT INTO reviews (id_product, name_user, photo_user, stars, title, description) VALUES (:id_product, :name_user, :photo_user, :stars, :title, :description)');
        
        $req->bindValue(':id_product', $review->idProduct(), PDO::PARAM_INT);
        $req->bindValue(':name_user', $review->nameUser(), PDO::PARAM_STR);
        $req->bindValue(':photo_user', $review->photoUser(), PDO::PARAM_STR);
        $req->bindValue(':stars', $review->stars(), PDO::PARAM_INT);
        $req->bindValue(':title', $review->title(), PDO::PARAM_STR);
        $req->bindValue(':description', $review->description(), PDO::PARAM_STR);

        $req->execute();
        $req->closeCursor();
    }

    /**
     * Supprime un avis de la base de données
     * @param int $id
     * @return void
     */
    public function deleteReview($review)
    {
        $req = $this->getBdd()->prepare('DELETE FROM reviews WHERE title = :title AND name_user = :user AND id_product = :id');
        $req->bindValue(':title', $review->getTitle(), PDO::PARAM_STR);
        $req->bindValue(':user', $review->getNameUser(), PDO::PARAM_STR);
        $req->bindValue(':id', $review->getIdProduct(), PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }

    /**
     * Modifie un avis dans la base de données
     * @param Reviews $review
     * @return void
     */
    public function updateReview(Reviews $review)
    {
        $req = $this->getBdd()->prepare('UPDATE reviews SET stars = :stars, title = :title, description = :description WHERE title = :title AND name_user = :user AND id_product = :id');
        $req->bindValue(':stars', $review->stars(), PDO::PARAM_INT);
        $req->bindValue(':title', $review->title(), PDO::PARAM_STR);
        $req->bindValue(':description', $review->description(), PDO::PARAM_STR);
        $req->bindValue(':title', $review->title(), PDO::PARAM_STR);
        $req->bindValue(':user', $review->nameUser(), PDO::PARAM_STR);
        $req->bindValue(':id', $review->idProduct(), PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }

}