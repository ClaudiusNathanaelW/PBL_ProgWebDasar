<?php 
$conn = require '../../config.php';
include '../layouts/header.php'; 
include '../layouts/sidebar.php'; 
?>

<link rel="stylesheet" href="../../assets/css/add_movie.css">
<script src="../../assets/js/add_moviee.js"></script>

<div class="main-content">
    <div class="form-container">
        <form action="#" method="POST">
            
            <div class="form-col-left">
                <div class="form-group">
                    <label>Movie Title</label>
                    <input type="text" class="form-control">
                </div>

                <div class="form-group">
                    <label>Synopsis</label>
                    <textarea class="form-control"></textarea>
                </div>

                <div class="clearfix">
                    <div class="form-group" style="float: left; width: 48%;">
                        <label>Duration (Minutes)</label>
                        <input type="number" class="form-control" placeholder="e.g. 120">
                    </div>
                    <div class="form-group" style="float: right; width: 48%;">
                        <label>Release Date</label>
                        <input type="date" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label>Rating</label>
                    <input type="number" class="form-control" step="0.1" min="0" max="10" placeholder="0.0">
                </div>

                <div class="form-group">
                    <label>Age Rating</label>
                    <select class="form-control">
                        <option value="" disabled selected>Pilih Rating Umur...</option>
                        <option value="SU">SU(Semua Umur)</option>
                        <option value="13+">13+(Bimbingan Orang Tua)</option>
                        <option value="17+">17+ (Dewasa)</option>
                        <option value="21+">21+ (Khusus Dewasa)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Genre </label>
                    <div class="checkbox-container">
                        <label class="checkbox-item">
                            <input type="checkbox" name="genre[]" value="Action"> Action
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="genre[]" value="Comedy"> Comedy
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="genre[]" value="Drama"> Drama
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="genre[]" value="Horror"> Horror
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="genre[]" value="Romance"> Romance
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="genre[]" value="Sci-Fi"> Sci-Fi
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="genre[]" value="Thriller"> Thriller
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-col-right">
                <div class="form-group">
                    <label>Movie Poster (PNG/JPEG)</label>
                    <input type="file" class="form-control" id="poster-input" accept="image/png, image/jpeg">
                    <div class="preview-box" id="poster-preview" style="height: 200px;">
                        <span class="preview-text">[Image Preview ]</span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Trailer URL</label>
                    <input type="url" class="form-control" placeholder="https://youtube.com/...">
                    <div class="preview-box" style="height: 120px;">
                        <span class="preview-text">[ Trailer Preview]</span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Related Merchandise</label>
                    <div class="merch-box clearfix">
                        <h4>Add Merch Item</h4>
                        
                        <input type="text" class="form-control" placeholder="Merch Name" style="margin-bottom: 5px;">
                        <input type="file" class="form-control" id="merch-input" accept="image/*" style="margin-bottom: 10px;">
                        
                        <div class="preview-box" id="merch-preview" style="height: 100px; margin-bottom: 10px;">
                            <span class="preview-text">[Merch Preview]</span>
                        </div>

                        <div class="clearfix">
                            <div style="float: left; width: 48%;">
                                <input type="number" class="form-control" placeholder="Price (Rp)">
                            </div>
                            <div style="float: right; width: 48%;">
                                <input type="number" class="form-control" placeholder="Stock">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="action-buttons">
                <button type="button" class="btn btn-cancel">Cancel</button>
                <button type="submit" class="btn btn-submit">Save Movie</button>
            </div>

        </form>
    </div>
</div>

<div class="clearfix"></div>