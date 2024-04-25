<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class NewinController extends Controller
{
    /**
     * return view for all new products
     */
    public function newProducts(): View
    {
        $newProducts = $this->fetchAllNewProducts();

        return view('newIn.newin', compact('newProducts'));
    }

    /**
     * return view for all latest products in clothing
     */
    public function newCloths(): View
    {
        $newCloths = $this->fetchNewCloths();

        return view('newIn.newCloths', compact('newCloths'));
    }

    /**
     * return view for all the latest products in accessories
     */
    public function newAccessories()
    {
        $newAccessories = $this->fetchNewAccessories();

        return view('newIn.newAccessories', compact('newAccessories'));
    }

    /**
     * return view for all the latest products in shoes
     */
    public function newShoes()
    {
        $newShoes = $this->fetchNewShoes();

        return view('newIn.newShoes', compact('newShoes'));
    }

    /**
     * fetch all new products
     *
     * @return mixed
     */
    private function fetchAllNewProducts()
    {
        return Product::latest()
            ->limit(20)
            ->get();
    }

    /**
     * fetch all new cloths
     *
     * @return mixed
     */
    private function fetchNewCloths()
    {
        return Product::where('category_id', 1)
            ->latest()
            ->limit(20)
            ->get();
    }

    /**
     * fetch all new accessories
     *
     * @return mixed
     */
    private function fetchNewAccessories()
    {
        return Product::where('category_id', 5)
            ->latest()
            ->limit(20)
            ->get();
    }

    /**
     * fetch all new shoes
     *
     * @return mixed
     */
    private function fetchNewShoes()
    {
        return Product::where('category_id', 3)
            ->latest()
            ->limit(20)
            ->get();
    }

    /**
     * fetch all new Gadgets
     *
     * @return mixed
     */
    private function fetchNewGadgets()
    {
        return Product::where('category_id', 3)
            ->latest()
            ->limit(20)
            ->get();
    }
}
