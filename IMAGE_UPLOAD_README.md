# User Item Image Upload System

This system provides image upload functionality for user items in Filament v4 with automatic WebP conversion and multiple size generation.

## Features

- **Multiple Image Upload**: Upload multiple images per user item
- **Automatic WebP Conversion**: All images are converted to WebP format for optimal performance
- **Multiple Sizes**: Each image is automatically resized to 3 sizes:
  - Thumb: 320px (for thumbnails and previews)
  - Small: 640px (for medium displays)
  - Large: 1024px (for full-size viewing)
- **Smart Storage**: Local storage with easy AWS S3 migration
- **JSON Structure**: Images stored in JSON format in database for flexibility

## Storage Structure

Images are stored in the following directory structure:
```
storage/app/public/user-items/useritems/{item_id}/{image_md5_hash}-{size}.webp
```

Example:
```
storage/app/public/user-items/useritems/123/abc123def456-thumb.webp
storage/app/public/user-items/useritems/123/abc123def456-small.webp
storage/app/public/user-items/useritems/123/abc123def456-large.webp
```

## JSON Database Structure

Images are stored in the `images` column as JSON:
```json
{
  "abc123def456": {
    "thumb": "http://localhost/storage/user-items/useritems/123/abc123def456-thumb.webp",
    "small": "http://localhost/storage/user-items/useritems/123/abc123def456-small.webp",
    "large": "http://localhost/storage/user-items/useritems/123/abc123def456-large.webp"
  },
  "def789ghi012": {
    "thumb": "http://localhost/storage/user-items/useritems/123/def789ghi012-thumb.webp",
    "small": "http://localhost/storage/user-items/useritems/123/def789ghi012-small.webp",
    "large": "http://localhost/storage/user-items/useritems/123/def789ghi012-large.webp"
  }
}
```

## Configuration

### Local Storage (Default)
Add to your `.env` file:
```env
USER_ITEMS_DISK=local
```

### AWS S3 Storage
Add to your `.env` file:
```env
USER_ITEMS_DISK=user_items_s3
AWS_ACCESS_KEY_ID=your_access_key
AWS_SECRET_ACCESS_KEY=your_secret_key
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your_bucket_name
```

## Usage in Filament

### Editing Items
1. Navigate to Items → Edit Item
2. Expand the "Images" section
3. Click "Choose files" or drag and drop images
4. Supported formats: JPEG, PNG, GIF, WebP
5. Maximum file size: 10MB per image
6. Maximum files: 10 images per item
7. Save the item to process and store images

### Viewing Images
- Thumbnail grid displays all uploaded images
- Click on any thumbnail to view full-size image in modal
- Each image shows its MD5 hash for reference

## Components

### ImageProcessingService
- `app/Services/ImageProcessingService.php`
- Handles image processing, resizing, and WebP conversion
- Manages file storage and URL generation

### ItemForm Schema
- `app/Filament/Resources/Items/Schemas/ItemForm.php`
- Contains the file upload component
- Includes image gallery display

### EditItem Page
- `app/Filament/Resources/Items/Pages/EditItem.php`
- Handles image processing after form save
- Cleans up temporary files

## File Structure
```
app/
├── Services/
│   └── ImageProcessingService.php
├── Filament/
│   └── Resources/
│       └── Items/
│           ├── Pages/
│           │   └── EditItem.php
│           └── Schemas/
│               └── ItemForm.php
└── Models/
    └── UserItem.php (updated with images field)

resources/views/filament/components/
└── item-image-gallery.blade.php

storage/app/
├── public/user-items/        # Local storage
├── temp-uploads/             # Temporary upload processing
└── ...

config/
└── filesystems.php (updated with user_items disks)
```

## Migration

The following migrations were created:
- `add_images_column_to_user_items_table.php`
- `add_images_column_to_user_locations_table.php`
- `add_images_column_to_user_profiles_table.php`

## Dependencies

- **Intervention Image**: For image processing and WebP conversion
- **Filament v4**: Admin panel framework

## Error Handling

- Failed image processing is logged but doesn't break the flow
- Temporary files are cleaned up automatically
- Invalid files are ignored with error logging

## Performance Considerations

- Images are processed asynchronously after form save
- WebP format provides smaller file sizes
- Multiple sizes prevent loading large images when not needed
- Temporary files are cleaned up to prevent disk space issues

## Migration to S3

To migrate from local storage to S3:

1. Update your `.env` file with S3 credentials
2. Change `USER_ITEMS_DISK=user_items_s3`
3. Optionally run a migration script to copy existing images to S3
4. The system will automatically use S3 for new uploads

## Troubleshooting

### Images not processing
- Check that GD extension is installed (`php -m | grep gd`)
- Ensure storage directories have correct permissions
- Check Laravel logs for specific errors

### Images not displaying
- Run `php artisan storage:link` to create storage symlink
- Verify `APP_URL` is correctly set in `.env`
- Check browser network tab for 404 errors on image URLs

### Temporary files accumulating
- Temporary files should be cleaned up automatically
- Manually clean: `rm -rf storage/app/temp-uploads/*`