<div class="container margin-top-admin-list">
    <div class="row ">
        <div class="col ">
            <h2>USUARIOS</h2>
            <hr>
            <?php foreach ($users as $user) : ?>
                <div class="text-center">
                    <ul class="user-attributes d-flex align-items-center">
                        <?php if ($user->image !== null) : ?>
                            <li class="user-attribute">
                                <img class="image-size" src="data:image/jpeg;base64,<?php echo base64_encode($user->image); ?>" alt="Imagen de perfil">
                            </li>
                        <?php else : ?>
                            <li class="user-attribute">
                                <img class="image-size" src="/images/noimage.jpg" alt="Imagen de perfil">
                            </li>
                        <?php endif; ?>
                        <li class="user-attribute">ID: <?php echo $user->id; ?></li>
                        <li class="user-attribute">User: <?php echo $user->name; ?></li>
                        <li class="user-attribute">Email: <?php echo $user->email; ?></li>
                        <li class="user-attribute">Role: <?php echo $user->role; ?></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h2>LIBROS</h2>
            <hr>
            <?php foreach ($books as $book) : ?>
                <div class="text-center">
                    <ul class="book-attributes d-flex align-items-center">
                        <?php if ($book->cover !== null) : ?>
                            <li class="book-attribute">
                                <img class="image-size" src="data:image/jpeg;base64,<?php echo base64_encode($book->cover); ?>" alt="Imagen de perfil">
                            </li>
                        <?php else : ?>
                            <li class="book-attribute">
                                <img class="image-size" src="/images/noimage.jpg" alt="Imagen de perfil">
                            </li>
                        <?php endif; ?>
                        <li class="book-attribute">ID: <?php echo $book->id; ?></li>
                        <li class="book-attribute">Name: <?php echo $book->name; ?></li>
                        <li class="book-attribute">Author: <?php echo $book->author; ?></li>
                        <li class="book-attribute">Genre: <?php echo $book->genre; ?></li>
                        <li class="book-attribute">Pages: <?php echo $book->pages; ?></li>
                        <li class="book-attribute">Rating: <?php echo $book->rating; ?></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>