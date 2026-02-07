<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $title_en
 * @property string $slug
 * @property string|null $slug_en
 * @property string|null $content
 * @property string|null $content_en
 * @property string|null $image
 * @property string|null $category
 * @property string|null $category_en
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property string|null $author
 * @property-read mixed $image_url
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereCategoryEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereContentEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereSlugEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereTitleEn($value)
 */
	class BlogPost extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nom_compagnie
 * @property string|null $note_speciale
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompagnieType> $types
 * @property-read int|null $types_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompagnieInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompagnieInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompagnieInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompagnieInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompagnieInfo whereNomCompagnie($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompagnieInfo whereNoteSpeciale($value)
 */
	class CompagnieInfo extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $compagnie_id
 * @property string $nom_type
 * @property-read \App\Models\CompagnieInfo $compagnie
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompagnieType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompagnieType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompagnieType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompagnieType whereCompagnieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompagnieType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompagnieType whereNomType($value)
 */
	class CompagnieType extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $color
 * @property string|null $permissions
 * @property int|null $is_protected
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereIsProtected($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role wherePermissions($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $company
 * @property string|null $type_placement
 * @property string|null $option_nom
 * @property numeric|null $taux_mensuel
 * @property numeric|null $taux_initial
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TauxCommission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TauxCommission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TauxCommission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TauxCommission whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TauxCommission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TauxCommission whereOptionNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TauxCommission whereTauxInitial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TauxCommission whereTauxMensuel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TauxCommission whereTypePlacement($value)
 */
	class TauxCommission extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title_name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TeamTitle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TeamTitle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TeamTitle query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TeamTitle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TeamTitle whereTitleName($value)
 */
	class TeamTitle extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string $category
 * @property string|null $link
 * @property string|null $file_path
 * @property string|null $description
 * @property string|null $icon
 * @property int|null $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property-read mixed $action_url
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tool newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tool newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tool query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tool whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tool whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tool whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tool whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tool whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tool whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tool whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tool wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tool whereTitle($value)
 */
	class Tool extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $email
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $last_login
 * @property int|null $role_id
 * @property int|null $title_id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $slug
 * @property string|null $phone
 * @property string|null $city
 * @property string|null $bio
 * @property string|null $image
 * @property string|null $facebook_url
 * @property string|null $booking_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property int|null $position
 * @property bool|null $must_change_password
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $avatar_url
 * @property-read mixed $full_name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Role|null $role
 * @property-read \App\Models\TeamTitle|null $title
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBookingUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFacebookUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereMustChangePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTitleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Filament\Models\Contracts\HasName {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string $category
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $author_id
 * @property string|null $file_path
 * @property-read \App\Models\User|null $author
 * @property-read mixed $file_url
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WikiArticle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WikiArticle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WikiArticle query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WikiArticle whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WikiArticle whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WikiArticle whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WikiArticle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WikiArticle whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WikiArticle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WikiArticle whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WikiArticle whereUpdatedAt($value)
 */
	class WikiArticle extends \Eloquent {}
}

