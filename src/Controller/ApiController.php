<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @Route("/api/categories/", name="get_categories", methods={"GET"})
     */
    public function getAllCategories(): Response
    {
        $arr = [];
        foreach($this->categoryRepository->findAll() as $category) {
            $arr[] = [
                'id' => $category->getId(),
                'name' => $category->getName(),
            ];
        }
        return new JsonResponse([
            'status' => true,
            'data' => $arr,
        ]);
    }

    /**
     * @Route("/api/category/{id<\d+>}/", name="get_one_category", methods={"GET"})
     */
    public function getCategory(Category $category): Response
    {
        return new JsonResponse([
            'status' => true,
            'name' => $category->getName(),
        ]);
    }

    /**
     * @Route("/api/category/", name="add_category", methods={"POST"})
     */
    public function addCategory(Request $request): Response
    {
        $status = false;
        $lastId = null;
        $content = $request->getContent();
        $content = json_decode($content);
        $name = $content->name;
        if ('' !== $name) {
            $category = new Category();
            $category->setName($name);
            $this->categoryRepository->add($category, true);
            $status = true;
            $lastId = $category->getId();
        }
        return new JsonResponse([
            'status' => $status,
            'id' => $lastId,
        ]);
    }

    /**
     * @Route("/api/category/", name="put_category", methods={"PUT"})
     */
    public function putCategory(Request $request): Response
    {
        $status = false;
        $content = $request->getContent();
        $content = json_decode($content);
        $id = $content->id;
        $category = $this->categoryRepository->find($id);
        if ($category) {
            $name = $content->name;
            if ('' !== $name) {
                $category->setName($name);
                $this->categoryRepository->add($category, true);
                $status = true;
            }
        }

        return new JsonResponse([
            'status' => $status,
            'name' => $category->getName(),
        ]);
    }

    /**
     * @Route("/api/category/{id<\d+>}/", name="remove_category", methods={"DELETE"})
     */
    public function removeCategory(Category $category): Response
    {
        $name = $category->getName();
        $this->categoryRepository->remove($category, true);
        return new JsonResponse([
            'status' => true,
            'name' => $name,
        ]);
    }
}