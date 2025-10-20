IMPORTANT
Only use filament 4.1+ and stick to Laravel best practices. Try do use the latest in functions by looking at whats new in filament https://filamentphp.com/content/danharrin-filament-v4-1

## Critical Implementation Notes

### Namespace Requirements
- Form components MUST use `Filament\Forms\Components` namespace, NOT `Filament\Schemas\Components`
- Examples: `Filament\Forms\Components\TextInput`, `Filament\Forms\Components\FileUpload`
- Schema configuration uses `Filament\Schemas\Schema`

### Navigation Group Configuration
- Use METHODS not properties for navigation groups in Filament 4.1+
- Correct: `public static function getNavigationGroup(): ?string { return 'Media'; }`
- Incorrect: `protected static ?string $navigationGroup = 'Media';`
- Same applies to `getNavigationSort()`

### Action Size Enum
- `Filament\Support\Enums\ActionSize` does NOT exist in Filament 4.1
- Do NOT use `->size(ActionSize::Small)` on actions
- Actions work fine without explicit size specification

### Null Safety in Column Visibility
- Always check for null records in `visible()` closures
- Example: `->visible(fn ($record) => $record && !$record->is_image)`
- Without null check, will throw "Attempt to read property on null" errors

### File Upload in Relation Managers
- Do NOT use complex `saveRelationshipsUsing()` callbacks in FileUpload fields
- Instead, create custom header actions with FileUpload in modal forms
- Use `FilamentAction::make()` with `->form()` and `->action()` methods
- Handle file processing in the action callback with access to `$livewire->getOwnerRecord()`

## Task
I want you to create a new section in the filament admin called Media and a new segment called "Folders".

1. Folders will be the menu point under the title "Media"
2. When clicked on "Folders" you will get the option to create a new folder.
3. When created a new folder it will be in the list of folders.
4. When clicking on a folder you will get the basics at the top where you can change the title, description etc. There will also be a "Add files" section where you can add all sorts of files to the folder. Most commonly images. A section where you can drop all files at once is preferable.
5. The images that are uploaded should have a relation table in the model and exists as rows that keeps track of the files. When deleting a row from images, you also delete the file. 
6. The image list should have two modes. Plain text where the columns title, extension, size and tstamps and a list where they are listed as thumbnails. Use a design where the images are contained in a square container and have a design where the images are at min 200 and max 300px wide and the grid that shows them will be as wide as the browser window.
7. If the file is an image, show the thumb created when uploaded. If the file is not an image show the text extension ".doc" in the thumbnail box

Do the migration when finished doing this development. 

IMPORTANT: After creating the migrations and models, you MUST run:
1. `php artisan migrate` - to create the database tables
2. `php artisan storage:link` - to create the public storage symlink (required for file access via URLs)

Summary:

1. Create Media segment in the menu.
2. Create Folders and Files 
3. Make sure we can create folders and upload images to folders
4. Run the migration when finished.
5. Create the storage symlink to make files publicly accessible.
