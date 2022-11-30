<?php
namespace App\Controller;

use App\Repository\ProgramRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route('/category/', name :'category_index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('category/index.html.twig',
    [
        'website' => 'Wild Series',
        'categories' => $categories,
    ]);
    }

    #[Route('/category/{categoryName}', name :'category_show')]
    public function show(CategoryRepository $categoryRepository, ProgramRepository $programRepository, string $categoryName): Response
    {
        $category = $categoryRepository->findOneBy(['name' => $categoryName]);
        if(is_null($category)) {
            echo('404');
            exit();
        }
        $categoryId = $category->getId();
        $programs = $programRepository->findBy(
            ['category'=> $categoryId],
            ['id'=> 'DESC'],
            3
            
        );
        return $this->render('category/show.html.twig',
    [
        'website' => 'Wild Series',
        'programs' => $programs,
    ]);
    }


}