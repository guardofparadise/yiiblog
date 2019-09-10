<div class="col-md-4" data-sticky_column>
                <div class="primary-sidebar">
                    
                    <aside class="widget">
                        <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>
												<?php foreach($popular as $popular_post) : ?>
                        <div class="popular-post">


                            <a href="#" class="popular-img"><img src="<?= $popular_post->getImage(); ?>" alt="">

                                <div class="p-overlay"></div>
                            </a>

                            <div class="p-content">
                                <a href="#" class="text-uppercase"><?= $popular_post->title; ?></a>
                                <span class="p-date"><?= $popular_post->getDate() ?></span>

                            </div>
                        </div>
										<?php endforeach; ?>
                    </aside>
                    <aside class="widget pos-padding">
                        <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>

												<?php foreach ($recent as $recent_post) : ?>
                        <div class="thumb-latest-posts">

                            <div class="media">
                                <div class="media-left">
                                    <a href="#" class="popular-img"><img src="<?= $recent_post->getImage(); ?>" alt="">
                                        <div class="p-overlay"></div>
                                    </a>
                                </div>
                                <div class="p-content">
                                    <a href="#" class="text-uppercase"><?= $recent_post->title; ?></a>
                                    <span class="p-date"><?= $recent_post->getDate(); ?></span>
                                </div>
                            </div>
                        </div>
												<?php endforeach; ?>

                    </aside>
                    <aside class="widget border pos-padding">
                        <h3 class="widget-title text-uppercase text-center">Categories</h3>
                        <ul>
													<?php foreach($categories as $category) : ?>
                            <li>
                                <a href="#"><?= $category->title ?></a>
                                <span class="post-count pull-right"> (<?= $category->getArticles()->count(); ?>)</span>
                            </li>
													<?php endforeach; ?>
                        </ul>
                    </aside>
                </div>
            </div>