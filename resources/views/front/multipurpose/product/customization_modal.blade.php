<!-- Customization Modal -->
<div class="modal fade" id="customizationModal" tabindex="-1" role="dialog" aria-labelledby="customizationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 20px; border: none;">
            <div class="modal-header" style="background: linear-gradient(45deg, #f39c12, #e67e22); border-radius: 20px 20px 0 0; border: none;">
                <h5 class="modal-title" id="customizationModalLabel" style="color: white; font-weight: 700; font-size: 1.5rem;">
                    <i class="fas fa-cog" style="margin-right: 10px;"></i>
                    Personnaliser votre commande
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body" style="padding: 30px;">
                <!-- Product Info -->
                <div class="product-info" style="background: #f8f9fa; border-radius: 15px; padding: 20px; margin-bottom: 25px; text-align: center;">
                    <h4 id="modalProductName" style="color: #2c3e50; font-weight: 700; margin-bottom: 10px;"></h4>
                    <p id="modalProductType" style="color: #7f8c8d; margin-bottom: 5px; font-size: 1.1rem;"></p>
                    <h5 id="modalProductPrice" style="color: #f39c12; font-weight: 700; font-size: 1.3rem; margin: 0;"></h5>
                </div>

                <!-- Meat Choice Section (for Tacos/Galettes) -->
                <div id="meatChoiceSection" class="customization-section" style="display: none; margin-bottom: 25px;">
                    <h5 style="color: #2c3e50; font-weight: 600; margin-bottom: 15px; border-bottom: 2px solid #e74c3c; padding-bottom: 10px;">
                        <i class="fas fa-drumstick-bite" style="margin-right: 10px; color: #e74c3c;"></i>
                        Choisissez votre viande
                    </h5>
                    <div class="meat-options" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px;">
                        <label class="meat-option" style="cursor: pointer; text-align: center;">
                            <input type="radio" name="meatChoice" value="kebab" style="display: none;">
                            <div class="meat-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-fire" style="font-size: 2rem; color: #e74c3c; margin-bottom: 10px;"></i>
                                <div class="meat-text" style="font-weight: 600; color: #2c3e50;">Kebab</div>
                            </div>
                        </label>
                        <label class="meat-option" style="cursor: pointer; text-align: center;">
                            <input type="radio" name="meatChoice" value="steak" style="display: none;">
                            <div class="meat-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-cut" style="font-size: 2rem; color: #e74c3c; margin-bottom: 10px;"></i>
                                <div class="meat-text" style="font-weight: 600; color: #2c3e50;">Steak</div>
                            </div>
                        </label>
                        <label class="meat-option" style="cursor: pointer; text-align: center;">
                            <input type="radio" name="meatChoice" value="chicken" style="display: none;">
                            <div class="meat-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-drumstick-bite" style="font-size: 2rem; color: #e74c3c; margin-bottom: 10px;"></i>
                                <div class="meat-text" style="font-weight: 600; color: #2c3e50;">Poulet</div>
                            </div>
                        </label>
                        <label class="meat-option" style="cursor: pointer; text-align: center;">
                            <input type="radio" name="meatChoice" value="jacket" style="display: none;">
                            <div class="meat-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-utensils" style="font-size: 2rem; color: #e74c3c; margin-bottom: 10px;"></i>
                                <div class="meat-text" style="font-weight: 600; color: #2c3e50;">Jacket</div>
                            </div>
                        </label>
                        <label class="meat-option" style="cursor: pointer; text-align: center;">
                            <input type="radio" name="meatChoice" value="cordon-bleu" style="display: none;">
                            <div class="meat-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-star" style="font-size: 2rem; color: #e74c3c; margin-bottom: 10px;"></i>
                                <div class="meat-text" style="font-weight: 600; color: #2c3e50;">Cordon Bleu</div>
                            </div>
                        </label>
                        <label class="meat-option" style="cursor: pointer; text-align: center;">
                            <input type="radio" name="meatChoice" value="tenders" style="display: none;">
                            <div class="meat-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-feather" style="font-size: 2rem; color: #e74c3c; margin-bottom: 10px;"></i>
                                <div class="meat-text" style="font-weight: 600; color: #2c3e50;">Tenders</div>
                            </div>
                        </label>
                        <label class="meat-option" style="cursor: pointer; text-align: center;">
                            <input type="radio" name="meatChoice" value="nuggets" style="display: none;">
                            <div class="meat-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-circle" style="font-size: 2rem; color: #e74c3c; margin-bottom: 10px;"></i>
                                <div class="meat-text" style="font-weight: 600; color: #2c3e50;">Nuggets</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Vegetables Section -->
                <div id="vegetablesSection" class="customization-section" style="display: none; margin-bottom: 25px;">
                    <h5 style="color: #2c3e50; font-weight: 600; margin-bottom: 15px; border-bottom: 2px solid #27ae60; padding-bottom: 10px;">
                        <i class="fas fa-leaf" style="margin-right: 10px; color: #27ae60;"></i>
                        Légumes
                    </h5>
                    <div class="vegetable-options" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 15px;">
                        <label class="vegetable-option" style="cursor: pointer; text-align: center;">
                            <input type="checkbox" name="vegetables" value="tomatoes" style="display: none;">
                            <div class="vegetable-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-circle" style="font-size: 1.5rem; color: #e74c3c; margin-bottom: 8px;"></i>
                                <div class="vegetable-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Tomates</div>
                            </div>
                        </label>
                        <label class="vegetable-option" style="cursor: pointer; text-align: center;">
                            <input type="checkbox" name="vegetables" value="salad" style="display: none;">
                            <div class="vegetable-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-leaf" style="font-size: 1.5rem; color: #27ae60; margin-bottom: 8px;"></i>
                                <div class="vegetable-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Salade</div>
                            </div>
                        </label>
                        <label class="vegetable-option" style="cursor: pointer; text-align: center;">
                            <input type="checkbox" name="vegetables" value="onions" style="display: none;">
                            <div class="vegetable-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-circle" style="font-size: 1.5rem; color: #8e44ad; margin-bottom: 8px;"></i>
                                <div class="vegetable-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Oignons</div>
                            </div>
                        </label>
                        <label class="vegetable-option" style="cursor: pointer; text-align: center;">
                            <input type="checkbox" name="vegetables" value="no-vegetables" style="display: none;">
                            <div class="vegetable-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-times-circle" style="font-size: 1.5rem; color: #95a5a6; margin-bottom: 8px;"></i>
                                <div class="vegetable-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Sans légumes</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Drink Choice Section (for Menu Items) -->
                <div id="drinkChoiceSection" class="customization-section" style="display: none; margin-bottom: 25px;">
                    <h5 style="color: #2c3e50; font-weight: 600; margin-bottom: 15px; border-bottom: 2px solid #3498db; padding-bottom: 10px;">
                        <i class="fas fa-glass-whiskey" style="margin-right: 10px; color: #3498db;"></i>
                        Choisissez votre boisson
                    </h5>
                    <div class="drink-options" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 15px;">
                        <label class="drink-option" style="cursor: pointer; text-align: center;">
                            <input type="radio" name="drinkChoice" value="coca-cola" style="display: none;">
                            <div class="drink-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-tint" style="font-size: 1.5rem; color: #8b0000; margin-bottom: 8px;"></i>
                                <div class="drink-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Coca-Cola</div>
                            </div>
                        </label>
                        <label class="drink-option" style="cursor: pointer; text-align: center;">
                            <input type="radio" name="drinkChoice" value="coca-cherry" style="display: none;">
                            <div class="drink-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-tint" style="font-size: 1.5rem; color: #8b0000; margin-bottom: 8px;"></i>
                                <div class="drink-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Coca Cherry</div>
                            </div>
                        </label>
                        <label class="drink-option" style="cursor: pointer; text-align: center;">
                            <input type="radio" name="drinkChoice" value="coca-zero" style="display: none;">
                            <div class="drink-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-tint" style="font-size: 1.5rem; color: #8b0000; margin-bottom: 8px;"></i>
                                <div class="drink-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Coca Zero</div>
                            </div>
                        </label>
                        <label class="drink-option" style="cursor: pointer; text-align: center;">
                            <input type="radio" name="drinkChoice" value="oasis-tropical" style="display: none;">
                            <div class="drink-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-tint" style="font-size: 1.5rem; color: #ff6b35; margin-bottom: 8px;"></i>
                                <div class="drink-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Oasis Tropical</div>
                            </div>
                        </label>
                        <label class="drink-option" style="cursor: pointer; text-align: center;">
                            <input type="radio" name="drinkChoice" value="oasis-apple" style="display: none;">
                            <div class="drink-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-tint" style="font-size: 1.5rem; color: #27ae60; margin-bottom: 8px;"></i>
                                <div class="drink-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Oasis Apple</div>
                            </div>
                        </label>
                        <label class="drink-option" style="cursor: pointer; text-align: center;">
                            <input type="radio" name="drinkChoice" value="ice-tea" style="display: none;">
                            <div class="drink-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-tint" style="font-size: 1.5rem; color: #8b4513; margin-bottom: 8px;"></i>
                                <div class="drink-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Ice Tea</div>
                            </div>
                        </label>
                        <label class="drink-option" style="cursor: pointer; text-align: center;">
                            <input type="radio" name="drinkChoice" value="fuze-tea" style="display: none;">
                            <div class="drink-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-tint" style="font-size: 1.5rem; color: #8b4513; margin-bottom: 8px;"></i>
                                <div class="drink-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Fuze Tea</div>
                            </div>
                        </label>
                        <label class="drink-option" style="cursor: pointer; text-align: center;">
                            <input type="radio" name="drinkChoice" value="sprite" style="display: none;">
                            <div class="drink-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-tint" style="font-size: 1.5rem; color: #27ae60; margin-bottom: 8px;"></i>
                                <div class="drink-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Sprite</div>
                            </div>
                        </label>
                        <label class="drink-option" style="cursor: pointer; text-align: center;">
                            <input type="radio" name="drinkChoice" value="fanta-orange" style="display: none;">
                            <div class="drink-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-tint" style="font-size: 1.5rem; color: #ff8c00; margin-bottom: 8px;"></i>
                                <div class="drink-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Fanta Orange</div>
                            </div>
                        </label>
                        <label class="drink-option" style="cursor: pointer; text-align: center;">
                            <input type="radio" name="drinkChoice" value="tropico" style="display: none;">
                            <div class="drink-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-tint" style="font-size: 1.5rem; color: #ff8c00; margin-bottom: 8px;"></i>
                                <div class="drink-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Tropico</div>
                            </div>
                        </label>
                        <label class="drink-option" style="cursor: pointer; text-align: center;">
                            <input type="radio" name="drinkChoice" value="orangina" style="display: none;">
                            <div class="drink-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-tint" style="font-size: 1.5rem; color: #ff8c00; margin-bottom: 8px;"></i>
                                <div class="drink-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Orangina</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Sauces Section -->
                <div id="saucesSection" class="customization-section" style="display: none; margin-bottom: 25px;">
                    <h5 style="color: #2c3e50; font-weight: 600; margin-bottom: 15px; border-bottom: 2px solid #e67e22; padding-bottom: 10px;">
                        <i class="fas fa-fire" style="margin-right: 10px; color: #e67e22;"></i>
                        Sauces
                    </h5>
                    <div class="sauce-options" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 15px;">
                        <label class="sauce-option" style="cursor: pointer; text-align: center;">
                            <input type="checkbox" name="sauces" value="white-sauce" style="display: none;">
                            <div class="sauce-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-tint" style="font-size: 1.5rem; color: #f8f9fa; margin-bottom: 8px;"></i>
                                <div class="sauce-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Sauce Blanche</div>
                            </div>
                        </label>
                        <label class="sauce-option" style="cursor: pointer; text-align: center;">
                            <input type="checkbox" name="sauces" value="mayonnaise" style="display: none;">
                            <div class="sauce-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-tint" style="font-size: 1.5rem; color: #f8f9fa; margin-bottom: 8px;"></i>
                                <div class="sauce-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Mayonnaise</div>
                            </div>
                        </label>
                        <label class="sauce-option" style="cursor: pointer; text-align: center;">
                            <input type="checkbox" name="sauces" value="ketchup" style="display: none;">
                            <div class="sauce-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-tint" style="font-size: 1.5rem; color: #e74c3c; margin-bottom: 8px;"></i>
                                <div class="sauce-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Ketchup</div>
                            </div>
                        </label>
                        <label class="sauce-option" style="cursor: pointer; text-align: center;">
                            <input type="checkbox" name="sauces" value="harissa" style="display: none;">
                            <div class="sauce-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-fire" style="font-size: 1.5rem; color: #e74c3c; margin-bottom: 8px;"></i>
                                <div class="sauce-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Harissa</div>
                            </div>
                        </label>
                        <label class="sauce-option" style="cursor: pointer; text-align: center;">
                            <input type="checkbox" name="sauces" value="mustard" style="display: none;">
                            <div class="sauce-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-tint" style="font-size: 1.5rem; color: #f39c12; margin-bottom: 8px;"></i>
                                <div class="sauce-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Moutarde</div>
                            </div>
                        </label>
                        <label class="sauce-option" style="cursor: pointer; text-align: center;">
                            <input type="checkbox" name="sauces" value="bbq" style="display: none;">
                            <div class="sauce-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-fire" style="font-size: 1.5rem; color: #8b4513; margin-bottom: 8px;"></i>
                                <div class="sauce-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">BBQ</div>
                            </div>
                        </label>
                        <label class="sauce-option" style="cursor: pointer; text-align: center;">
                            <input type="checkbox" name="sauces" value="curry" style="display: none;">
                            <div class="sauce-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-tint" style="font-size: 1.5rem; color: #f39c12; margin-bottom: 8px;"></i>
                                <div class="sauce-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Curry</div>
                            </div>
                        </label>
                        <label class="sauce-option" style="cursor: pointer; text-align: center;">
                            <input type="checkbox" name="sauces" value="algerienne" style="display: none;">
                            <div class="sauce-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-tint" style="font-size: 1.5rem; color: #e67e22; margin-bottom: 8px;"></i>
                                <div class="sauce-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Algérienne</div>
                            </div>
                        </label>
                        <label class="sauce-option" style="cursor: pointer; text-align: center;">
                            <input type="checkbox" name="sauces" value="samourai" style="display: none;">
                            <div class="sauce-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-fire" style="font-size: 1.5rem; color: #e74c3c; margin-bottom: 8px;"></i>
                                <div class="sauce-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Samouraï</div>
                            </div>
                        </label>
                        <label class="sauce-option" style="cursor: pointer; text-align: center;">
                            <input type="checkbox" name="sauces" value="andalouse" style="display: none;">
                            <div class="sauce-card" style="background: white; border: 2px solid #e9ecef; border-radius: 15px; padding: 15px; transition: all 0.3s ease;">
                                <i class="fas fa-tint" style="font-size: 1.5rem; color: #e67e22; margin-bottom: 8px;"></i>
                                <div class="sauce-text" style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Andalouse</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Quantity Section -->
                <div class="quantity-section" style="text-align: center; margin-bottom: 25px;">
                    <h5 style="color: #2c3e50; font-weight: 600; margin-bottom: 15px;">
                        <i class="fas fa-sort-numeric-up" style="margin-right: 10px; color: #3498db;"></i>
                        Quantité
                    </h5>
                    <div class="quantity-controls" style="display: flex; align-items: center; justify-content: center; gap: 20px;">
                        <button id="decreaseQuantity" type="button" style="background: #e74c3c; color: white; border: none; border-radius: 50%; width: 40px; height: 40px; font-size: 1.2rem; cursor: pointer; transition: all 0.3s ease;">
                            <i class="fas fa-minus"></i>
                        </button>
                        <span id="quantityDisplay" style="font-size: 1.5rem; font-weight: 700; color: #2c3e50; min-width: 50px;">1</span>
                        <button id="increaseQuantity" type="button" style="background: #27ae60; color: white; border: none; border-radius: 50%; width: 40px; height: 40px; font-size: 1.2rem; cursor: pointer; transition: all 0.3s ease;">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer" style="background: #f8f9fa; border-radius: 0 0 20px 20px; border: none; padding: 20px; text-align: center;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background: #95a5a6; border: none; border-radius: 10px; padding: 12px 25px; margin-right: 15px;">
                    <i class="fas fa-times" style="margin-right: 8px;"></i>
                    Annuler
                </button>
                <button type="button" id="addToCartBtn" class="btn btn-primary" style="background: linear-gradient(45deg, #f39c12, #e67e22); border: none; border-radius: 10px; padding: 12px 30px; font-weight: 600;">
                    <i class="fas fa-shopping-cart" style="margin-right: 8px;"></i>
                    Ajouter au panier
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Customization Modal Styles */
.meat-option input[type="radio"]:checked + .meat-card,
.vegetable-option input[type="checkbox"]:checked + .vegetable-card,
.drink-option input[type="radio"]:checked + .drink-card,
.sauce-option input[type="checkbox"]:checked + .sauce-card {
    background: linear-gradient(135deg, #f39c12, #e67e22) !important;
    border-color: #d68910 !important;
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(243, 156, 18, 0.3);
}

/* Ensure text remains readable when selected */
.meat-option input[type="radio"]:checked + .meat-card .meat-text,
.vegetable-option input[type="checkbox"]:checked + .vegetable-card .vegetable-text,
.drink-option input[type="radio"]:checked + .drink-card .drink-text,
.sauce-option input[type="checkbox"]:checked + .sauce-card .sauce-text {
    color: #ffffff !important;
    font-weight: 700 !important;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
}

/* Hover effects */
.meat-card:hover,
.vegetable-card:hover,
.drink-card:hover,
.sauce-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    border-color: #f39c12;
}

/* Quantity button hover effects */
#decreaseQuantity:hover {
    background: #c0392b !important;
    transform: scale(1.1);
}

#increaseQuantity:hover {
    background: #229954 !important;
    transform: scale(1.1);
}

/* Modal animations */
.modal.fade .modal-dialog {
    transition: transform 0.3s ease-out;
}

.modal.show .modal-dialog {
    transform: none;
}
</style>

<script>
// Global variables to store product information
let currentProductId = null;
let currentProductName = null;
let currentProductPrice = null;
let currentProductType = null;
let currentHasMeatChoice = false;
let currentIsMenu = false;
let currentQuantity = 1;

// Function to open the customization modal
function openCustomizationModal(productId, productName, price, type, hasMeatChoice, isMenu) {
    // Store current product information
    currentProductId = productId;
    currentProductName = productName;
    currentProductPrice = price;
    currentProductType = type;
    currentHasMeatChoice = hasMeatChoice;
    currentIsMenu = isMenu;
    currentQuantity = 1;
    
    // Update modal content
    document.getElementById('modalProductName').textContent = productName;
    document.getElementById('modalProductType').textContent = type;
    document.getElementById('modalProductPrice').textContent = price + '€';
    document.getElementById('quantityDisplay').textContent = '1';
    
    // Reset all form inputs
    resetModalForm();
    
    // Show/hide sections based on product type and options
    showCustomizationSections();
    
    // Show the modal
    $('#customizationModal').modal('show');
}

// Function to show/hide customization sections based on product type
function showCustomizationSections() {
    // Meat choice section - show for Tacos/Galettes
    const meatSection = document.getElementById('meatChoiceSection');
    meatSection.style.display = currentHasMeatChoice ? 'block' : 'none';
    
    // Vegetables section - show for all sandwiches and menu items (except Assiettes)
    const vegetablesSection = document.getElementById('vegetablesSection');
    vegetablesSection.style.display = (currentProductType !== 'Assiette') ? 'block' : 'none';
    
    // Drinks section - show for menu items only
    const drinksSection = document.getElementById('drinkChoiceSection');
    drinksSection.style.display = currentIsMenu ? 'block' : 'none';
    
    // Sauces section - show for all items
    const saucesSection = document.getElementById('saucesSection');
    saucesSection.style.display = 'block';
}

// Function to reset the modal form
function resetModalForm() {
    // Reset meat choice
    const meatInputs = document.querySelectorAll('input[name="meatChoice"]');
    meatInputs.forEach(input => input.checked = false);
    
    // Reset vegetables
    const vegetableInputs = document.querySelectorAll('input[name="vegetables"]');
    vegetableInputs.forEach(input => input.checked = false);
    
    // Reset drinks
    const drinkInputs = document.querySelectorAll('input[name="drinkChoice"]');
    drinkInputs.forEach(input => input.checked = false);
    
    // Reset sauces
    const sauceInputs = document.querySelectorAll('input[name="sauces"]');
    sauceInputs.forEach(input => input.checked = false);
    
    // Reset quantity
    currentQuantity = 1;
    document.getElementById('quantityDisplay').textContent = '1';
}

// Quantity controls
document.getElementById('decreaseQuantity').addEventListener('click', function() {
    if (currentQuantity > 1) {
        currentQuantity--;
        document.getElementById('quantityDisplay').textContent = currentQuantity;
    }
});

document.getElementById('increaseQuantity').addEventListener('click', function() {
    if (currentQuantity < 10) {
        currentQuantity++;
        document.getElementById('quantityDisplay').textContent = currentQuantity;
    }
});

// Add to cart button functionality
document.getElementById('addToCartBtn').addEventListener('click', function() {
    // Collect all selected options
    const customization = collectCustomizationOptions();
    
    // Add to cart with customization
    addToCartWithCustomization(customization);
});

// Function to collect all customization options
function collectCustomizationOptions() {
    const customization = {
        productId: currentProductId,
        productName: currentProductName,
        price: currentProductPrice,
        type: currentProductType,
        quantity: currentQuantity,
        meatChoice: null,
        vegetables: [],
        drinkChoice: null,
        sauces: []
    };
    
    // Get meat choice
    const selectedMeat = document.querySelector('input[name="meatChoice"]:checked');
    if (selectedMeat) {
        customization.meatChoice = selectedMeat.value;
    }
    
    // Get vegetables
    const selectedVegetables = document.querySelectorAll('input[name="vegetables"]:checked');
    selectedVegetables.forEach(input => {
        customization.vegetables.push(input.value);
    });
    
    // Get drink choice
    const selectedDrink = document.querySelector('input[name="drinkChoice"]:checked');
    if (selectedDrink) {
        customization.drinkChoice = selectedDrink.value;
    }
    
    // Get sauces
    const selectedSauces = document.querySelectorAll('input[name="sauces"]:checked');
    selectedSauces.forEach(input => {
        customization.sauces.push(input.value);
    });
    
    return customization;
}

// Function to add item to cart with customization
function addToCartWithCustomization(customization) {
    // Debug: Log the customization object
    console.log('Customization object:', customization);
    
    // Validate required selections based on product type
    if (currentHasMeatChoice && !customization.meatChoice) {
        alert('Veuillez choisir votre viande');
        return;
    }
    
    if (currentProductType !== 'Assiette' && customization.vegetables.length === 0) {
        alert('Veuillez choisir au moins une option de légumes');
        return;
    }
    
    if (customization.sauces.length === 0) {
        alert('Veuillez choisir au moins une sauce');
        return;
    }
    
    if (currentIsMenu && !customization.drinkChoice) {
        alert('Veuillez choisir votre boisson');
        return;
    }
    
    // Close the modal first
    $('#customizationModal').modal('hide');
    
    // Create form data
    const formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('customizations', JSON.stringify(customization));
    formData.append('quantity', customization.quantity);
    
    // Debug: Log the form data being sent
    console.log('Form data being sent:');
    console.log('_token:', '{{ csrf_token() }}');
    console.log('customizations:', JSON.stringify(customization));
    console.log('quantity:', customization.quantity);
    
    // Send AJAX request
    fetch('{{ route("add.cart", "") }}/' + customization.productId, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success && data.redirect) {
            // Redirect to cart page
            window.location.href = data.redirect;
        } else {
            // Fallback redirect
            window.location.href = '{{ route("front.cart") }}';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Fallback redirect on error
        window.location.href = '{{ route("front.cart") }}';
    });
}

// Initialize the modal when the page loads
document.addEventListener('DOMContentLoaded', function() {
    // Any additional initialization can go here
    console.log('Customization modal initialized');
});
</script> 