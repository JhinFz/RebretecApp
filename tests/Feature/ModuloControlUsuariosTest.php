<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

class ModuloControlUsuariosTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Crea un usuario administrador para las pruebas
        $this->adminUser = User::factory()->create(['is_admin' => true]);
        // Crea un usuario regular para pruebas adicionales si es necesario
        $this->regularUser = User::factory()->create(['is_admin' => false]);
    }

    /** @test */
    public function it_can_display_solicitudes_index()
    {
        $this->actingAs($this->adminUser) // Usuario autenticado
            ->get(route('admin.solicitud.index'))
            ->assertStatus(200)
            ->assertViewIs('admin.solicitud.index');
    }

    /** @test */
    public function it_can_edit_a_solicitud()
    {
        $solicitud = // Crear o obtener una solicitud existente

        $this->actingAs($this->adminUser)
            ->get(route('admin.solicitud.edit', $solicitud->id))
            ->assertStatus(200)
            ->assertViewIs('admin.solicitud.edit')
            ->assertViewHas('solicitud', $solicitud);
    }

    /** @test */
    public function it_can_delete_a_solicitud()
    {
        $solicitud = // Crear o obtener una solicitud existente

        $this->actingAs($this->adminUser)
            ->delete(route('admin.solicitud.destroy', $solicitud->id))
            ->assertRedirect()
            ->assertSessionHas('success', 'Solicitud eliminada correctamente.');

        $this->assertDeleted($solicitud);
    }

    /** @test */
    public function it_can_update_a_solicitud()
    {
        $solicitud = // Crear o obtener una solicitud existente

        $this->actingAs($this->adminUser)
            ->put(route('institucion.solicitud.update', $solicitud->id), [
                // Datos que necesitas actualizar
            ])
            ->assertRedirect(route('admin.solicitud.edit', $solicitud->id))
            ->assertSessionHas('info', 'Solicitud actualizada correctamente.');

        // Verificar que los cambios se hayan guardado en la base de datos
        $this->assertDatabaseHas('solicitudes', [
            // Datos que verificas
        ]);
    }

    /** @test */
    public function it_can_search_technical_user()
    {
        $this->actingAs($this->adminUser)
            ->get(route('buscar.tecnico'))
            ->assertStatus(200);
    }
}