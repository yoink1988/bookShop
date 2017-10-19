<?php
namespace Controllers;
/**
 * Description of Book
 *
 * @author yoink
 */
class Books
{
	public $model;
	public function __construct()
	{
		$this->model = new \Models\Books();

	}

	public function getBooks($params=null)
    {
		if(!isset($params['status']))
		{
			$params['status'] = 1;
		}
		$res = $this->model->getBooks($params);
		if($res)
		{
			\Utils\Response::SuccessResponse(200);
			\Utils\Response::doResponse($res);
		}
	}
	
	public function postBooks(array $params)
	{
		if((isset($params['book'])) && (isset($params['authors'])) && (isset($params['genres'])))
		{
			$params['book']['status'] = 1;
			if($bId = $this->model->addBook($params['book']))
			{
				$errs = 0;
				foreach ($params['authors'] as $author)
				{
					if(!$this->model->addAuthLink(array('id_book' => $bId, 'id_author' => $author)))
					{
						$errs++;
					}
				}

				foreach ($params['genres'] as $genre)
				{
					if(!$this->model->addGenreLink(array('id_book' => $bId, 'id_genre' => $genre)))
					{
						$errs++;
					}
				}
				if($errs == 0)
				{
					\Utils\Response::SuccessResponse(200);
					\Utils\Response::doResponse('Added');
				}
			}
		}

	}

	public function putBooks($params)
	{
//        print_r($params);
//		exit;

		if((isset($params['book'])) && (isset($params['authToDel'])) &&
			(isset($params['authToAdd'])) && (isset($params['genToDel'])) &&
			(isset($params['genToAdd'])))
		{
            $book = $params['book'];
            unset($params['book']);
            $bId = $book['id'];
            unset($book['id']);

            if($this->model->updateBook($bId, $book))
            {
                $errs = 0;
                if(!empty($params['authToAdd']))
                {
                    foreach($params['authToAdd'] as $aId)
                    {
                        if(!$this->model->addAuthLink(array('id_book' => $bId, 'id_author' => $aId)))
                        {
                            $errs++;
                        }
                    }
                }
                if(!empty($params['genToAdd']))
                {
                    foreach($params['genToAdd'] as $gId)
                    {
                        if(!$this->model->addGenreLink(array('id_book' => $bId, 'id_genre' => $gId)))
                        {
                            $errs++;
                        }
                    }
                }
                if(!empty($params['authToDel']))
                {
                    foreach($params['authToDel'] as $aId)
                    {
                        if(!$this->model->delAuthLink($bId, $aId))
                        {
                            $errs++;
                        }
                    }
                }
                if(!empty($params['genToDel']))
                {
                    foreach($params['genToDel'] as $gId)
                    {
                        if(!$this->model->delGenLink($bId, $gId))
                        {
                            $errs++;
                        }
                    }
                }
                if($errs == 0)
                {
 					\Utils\Response::SuccessResponse(200);
					\Utils\Response::doResponse('Updated');
                }
            } 

		}


//		if(!empty($params['id']))
//		{
//			$id = array_shift($params);
//			$this->model->updateBook($id,$params);
//		}
//		else
//		{
//			throw new \Exception('net Id');
//		}

	}
	public function deleteBooks($params)
	{
		if(!empty($params['id']))
		{
			$id = $params['id'];
			$this->model->deleteBook($id);
		}
		else
		{
			throw new \Exception('net Id -delete-');
		}
	}
}
