<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class BlogUserSearch extends BlogUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['email', 'password', 'username'], 'safe'],
        ] ;
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Create data provider instance with search query applied
     *
     * @params array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = BlogUser::find();

        //add conditions that shoud always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if($this->validate())
        {
            //uncomment the following line if you do not want to return any records when validations fail
            //$query->where('0=1');
            return $dataProvider;
        }

        //grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}