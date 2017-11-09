<?php

class CategoriesController extends AppController {

    public $uses = array('Category', 'CatDescription', 'Language', 'CategoryParent');

    public function index() {
        if (!empty($_POST)) {
            $condition['CatDescription.title  LIKE'] = '%' . $_POST['search'] . '%';
            $condition['CatDescription.lang'] = 'en';
            $condition['CatDescription.status'] = 1;
            $cat = $this->Category->find('all', array(
                'recursive' => -1,
                'contain' => array(
                    'CategoryParent' => array(
                        'CatDescription',
                    ),
                    'CatDescription' => array(
                        'conditions' => $condition
                    ),
                )
            ));
            $this->set(compact('cat'));
        }
    }

    public function create() {

        $lang_list = $this->getAllLangs();
        $Cat_list = $this->getAllCats();

        if ($_POST) {

            //check if any descriptions are null
            for ($i = 0; $i < count($lang_list); $i++) {
                if (empty($this->data['CatDescription'][$i]['title'])) {
                    unset($this->request->data['CatDescription'][$i]);
                }
            }


            $save = $this->Category->saveAll($this->data);
            if ($save) {
                $this->Session->setFlash(__('Successfully Saved。'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Failed, please retry。'));
            }
        }

        $this->set(compact('lang_list', 'Cat_list'));

        $this->render("detail");
    }

    public function edit($id) {

        $lang_list = $this->getAllLangs();
        $Cat_list = $this->getAllCats();

        $Cat_Detail = $this->Category->find('first', array(
            'conditions' => array(
                'Category.id' => $id),
            'contain' => array(
                'CatDescription'
            ))
        );

        // change $Cat_Detail key name for lang match in view
        for ($i = 0; $i < count($Cat_Detail['CatDescription']); $i++) {
            $lang = $Cat_Detail['CatDescription'][$i]['lang'];
            $Cat_Detail['CatDescription'][$lang] = $Cat_Detail['CatDescription'][$i];
            unset($Cat_Detail['CatDescription'][$i]);
        }

        if ($_POST) {

            //check if any descriptions are null
            for ($i = 0; $i < count($lang_list); $i++) {
                if (empty($this->data['CatDescription'][$i]['title'])) {
                    unset($this->request->data['CatDescription'][$i]);
                }
            }


            $save = $this->Category->saveAll($this->data);
            if ($save) {
                $this->Session->setFlash('Successfully Saved。');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Failed, please retry。');
            }
        }

        $this->set(compact('lang_list', 'Cat_list', 'Cat_Detail'));

        $this->render("detail");
    }

    public function delete($id = null) {
        $del = $this->Category->delete($id);
        if ($del) {
            $this->Session->setFlash(__('Deleted Successfully。'));
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash(__('Failed, Please retry。'));
        }
    }

    public function getAllLangs() {
        $lang_list = $this->Language->find('list', array(
            'fields' => array('Language.lang'),
            'conditions' => array('Language.status' => 1)
        ));

        return $lang_list;
    }

    public function getAllCats() {
        //$condition['CatDescription.lang'] = 'en';
        $cat_list = $this->Category->find('all', array(
            'contain' => array('CatDescriptionEn')
        ));
        $cat_list = Hash::combine($cat_list, '{n}.Category.id', '{n}.CatDescriptionEn.title');
        return $cat_list;
    }

}
